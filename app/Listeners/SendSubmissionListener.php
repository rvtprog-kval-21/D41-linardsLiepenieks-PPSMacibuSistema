<?php

namespace App\Listeners;

use App\Models\Profile;
use App\Models\Solution;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SendSubmissionListener implements ShouldQueue
{
    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    protected $host = 'judge0-ce.p.rapidapi.com';

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {

        $mode_id = $this->pickLanguage($event->submission->mode); //Id of programming language
        $correct = true; // Bool to check if solution is correct

        foreach ($event->exercise->tests()->get() as $test) //Go through all test cases for exercise
        {
            if($mode_id == 71)
            {
                $test->stdin = $this->convToPy($test->stdin);
            }
            //dd($test->stdin);
            $test_result = $this->testCode($mode_id, $event->submission->code, $test->stdin); //Compile code with this tests stdin
            //dd($test_result);




            $newTest = $event->submission->submissionTest()->create([
                    'time' => $test_result[1]['time'],
                    'memory' => $test_result[1]['memory']/1000,
                    'stdout' => $test_result[1]['stdout'],
                ]
            );//Add the compiled test result data to submission

            $newTest->stdout = rtrim($newTest->stdout);//Remove trailing whitespace

            //Check if test is completed correctly
            if ($newTest->stdout == $test->stdout && $event->exercise->time >= $newTest->time && $event->exercise->memory >= $newTest->memory)
            {
                $newTest->correct = true;
            }
            else {$correct = false;}

            $newTest->save(); //Save changes to this testcase submission

        }

        //If all tests completed correctly
        if ($correct == true) {


            //Check if the exercise was already solved by this user
            if ($event->user->Solution()->get()->Where('exercise_id', $event->exercise->id)->first() == null) {

                //Add score to user
                $profile = $event->user->profile()->first();
                $profile->score = $profile->score + $event->exercise->score;
                $profile->save();

            }

            //create a solution record
            $event->submission->solution()->create([
                'user_id' => $event->user->id,
                'exercise_id' => $event->exercise->id,
            ]);

        }
        $event->exercise->iesutijumi +=1;
        $event->exercise->save();


    }

    public function pickLanguage($mode = null) //Pick correct Language ID for Judge0 based on CodeMirror selection
    {
        switch ($mode) {
            case "C++":
                return 52;
                break;
            case "Python":
                return 71;
                break;
            case "Javascript":
                return 63;
                break;
            case "JAVA":
                return 62;
                break;
        }
    }

    public function testCode($languageId, $code, $stdin = null, $expected_output = null)
    {

        //Send submission test data to Judge0

        $response = Http::withHeaders([
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host,
            'content-type' => 'application/json',


        ])->post('https://judge0-ce.p.rapidapi.com/submissions', [
            'language_id' => $languageId,
            'source_code' => $code,
            'stdin' => $stdin,
            'expected_output' => $expected_output,
        ]);
        //dd($response);


        //Get unique Submission token for this test from API
        $submissionKey = json_decode($response);
        $submissionKey = $submissionKey->token;

         $status = 'In Queue';

        while($status === 'In Queue' || $status === 'Processing')
        {
            //Get submission test data from Judge0

            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->token,
                'x-rapidapi-host' => $this->host
            ])->get('https://judge0-ce.p.rapidapi.com/submissions/' . $submissionKey);
            $status = json_decode($response)->status->description;
            //dd($status);

        }
        //dd(json_decode($response));
            //If code is compiled return test data and stop retrying
            if ($status === 'Accepted') {
                return array('accepted', $response->json());
            }



        //If code is not compiled at this point something went wrong or it has timed out
        return array('timed-out', $response->json());

    }

    public function convToPy($stdin)
    {
        $newstr = str_replace(' ', "\n", $stdin);
        //$newstr = base64_encode($newstr);
        return $newstr;
    }

}
