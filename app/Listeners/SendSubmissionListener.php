<?php

namespace App\Listeners;

use App\Models\Contest;
use App\Models\Profile;
use App\Models\Solution;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use function GuzzleHttp\json_decode;

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
        $exercise_contests = $event->exercise->contest()->where('contestStart', '<', time() + 10800)->where('contestEnd', '>', time() + 10800)->get();
        $contestScore = 0;
        //dd($exercise_contests);


        $data = $this->sendBatch($mode_id, $event);
        //dd($data);
        $tests = $event->exercise->tests;
        foreach ($data['submissions'] as $index => $test_result) //Go through all test cases for exercise
        {
            /*if($mode_id == 71)
            {
                $test->stdin = $this->convToPy($test->stdin);
            }*/
            //dd($test->stdin);
            //$test_result = $this->testCode($mode_id, $event->submission->code, $test->stdin); //Compile code with these tests stdin
            //dd($test_result);


            $newTest = $event->submission->submissionTest()->create([
                    'time' => $test_result['time'],
                    'memory' => $test_result['memory'] / 1000,
                    'stdout' => $test_result['stdout'],
                ]
            );//Add the compiled test result data to submission

            $newTest->stdout = base64_decode(rtrim($newTest->stdout));//Remove trailing whitespace
            $newTest->stdout = trim($newTest->stdout);
            //dd($newTest->stdout == $event->exercise->tests[$index]->stdout);

            //Check if test is completed correctly
            if (preg_replace('/[^A-Za-z0-9\-]/', '', $event->exercise->tests[$index]->stdout) === preg_replace('/[^A-Za-z0-9\-]/', '', $newTest->stdout)
                && $event->exercise->time >= $newTest->time && $event->exercise->memory >= $newTest->memory) {
                $newTest->correct = true;
            } else {
                $correct = false;
            }

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

        foreach ($exercise_contests as $contest) {

            $spent_time = (time() + 10800 - $contest->contestStart) / 60;
            dd($contest->type == 'contest');
            if ($contest->type == 'contest') {
                if ($correct == true) {
                    if ($event->exercise->score > $spent_time) {
                        $contestScore = $event->exercise->score - $spent_time;
                    } else {
                        $contestScore = $event->exercise->minScore;
                    }
                } else {
                    $contestScore = 0;
                }


            } else {
                $testCaseScore = $event->exercise->score / $event->exercise->tests()->count();
                $correctTests = $event->submission->submissionTest()->where('correct', '=', true)->count();
                $contestScore = $testCaseScore * $correctTests;
            }

            $event->submission->contest()->attach($contest, ['score' => $contestScore, 'user_id' => Auth::user()->id, 'exercise_id' => $event->exercise->id]);

            if ($event->submission->contest()->first()->private == false
                &&
                $event->submission->contest()->first()->user()->where('user_id', '=', Auth::user()->id)->get()->count() <= 0) {
                Contest::Find($event->submission->contest()->first()->user()->attach(User::find(Auth::user()->id)));
            }

        }


        $event->exercise->save();


        return;


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

    public function sendBatch($mode, $event)
    {

        $tests = array();

        foreach ($event->exercise->tests()->get() as $test) {
            if ($mode == 71) {
                $test->stdin = $this->convToPy($test->stdin);
            }
            array_push($tests,
                ['source_code' => $event->submission->code,
                    'language_id' => $mode,
                    'stdin' => $test->stdin,
                    'expected_output' => $test->stdout]);
        }

        $response = Http::withHeaders([
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host,
            'content-type' => 'application/json',


        ])->post('https://judge0-ce.p.rapidapi.com/submissions/batch', [
            'submissions' => $tests
        ]);
        $submissionKeys = json_decode($response);
        $key = '';
        foreach ($submissionKeys as $token) {
            //dd($token);
            $key .= $token->token . ',';

        }
        $key = mb_substr($key, 0, -1);


        $response = Http::withHeaders([
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host
        ])->get('https://judge0-ce.p.rapidapi.com/submissions/batch?tokens=' . $key
            . '&base64_encoded=true');
        $temp = false;
        foreach (json_decode($response)->submissions as $test) {
            $status = 'In Queue';
            $thisToken = $test->token;

            while ($status === 'In Queue' || $status === 'Processing') {

                $testResponse = Http::withHeaders([
                    'x-rapidapi-key' => $this->token,
                    'x-rapidapi-host' => $this->host
                ])->get('https://judge0-ce.p.rapidapi.com/submissions/' . $thisToken
                    . '?base64_encoded=true');

                //dd(json_decode($testResponse));
                $status = json_decode($testResponse)->status->description;


            }


        }
        $response = Http::withHeaders([
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host
        ])->get('https://judge0-ce.p.rapidapi.com/submissions/batch?tokens=' . $key
            . '&base64_encoded=true');

        return $response->json();
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


        //Get unique Submission token for this test from API
        $submissionKey = json_decode($response);
        $submissionKey = $submissionKey->token;

        $status = 'In Queue';

        while ($status === 'In Queue' || $status === 'Processing') {
            //Get submission test data from Judge0

            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->token,
                'x-rapidapi-host' => $this->host
            ])->get('https://judge0-ce.p.rapidapi.com/submissions/' . $submissionKey);
            $status = json_decode($response)->status->description;

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
        return $newstr;
    }

}
