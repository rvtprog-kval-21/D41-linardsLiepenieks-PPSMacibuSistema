<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use App\Models\Profile;
use App\Models\Solution;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;


class Judge0Controller extends Controller
{
    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    protected $host = 'judge0-ce.p.rapidapi.com';

    public function tests(Submission $submission, exercise $exercise)
    {
        $mode_id = 0;
        switch ($submission->mode) {
            case "C++":
                $mode_id = 54;
                break;
            case "Python":
                $mode_id = 71;
                break;
            case "Javascript":
                $mode_id = 63;
                break;
            case "JAVA":
                $mode_id = 62;
                break;
        }


        $correct_solution = true;
        foreach ($exercise->tests()->get() as $test) {

            $test_output =
                $this->testCode($mode_id, $submission->code, $test->stdin);



            $newTest = $submission->submissionTest()->create([
                    'time' => $test_output[1]['time'],
                    'memory' => $test_output[1]['memory'] / 1000,
                    'stdout' => base64_decode($test_output[1]['stdout']),


                ]
            );

            $newTest->stdout = rtrim($newTest->stdout);
            if ($newTest->stdout == $test->stdout && $exercise->time >= $newTest->time && $exercise->memory >= $newTest->memory) {
                $newTest->correct = true;
            } else {
                $correct_solution = false;
            }
            $newTest->save();

        }

        if ($correct_solution == true) {
            if (Solution::Where('user_id', Auth::id())->first() == null && Solution::Where('exercise_id', $exercise->id)->first() == null) {
                $submission->solution()->create(
                    [
                        'user_id' => Auth::id(),
                        'exercise_id' => $exercise->id,
                    ]
                );

                $user = Profile::Where('user_id', Auth::id())->first();
                $user->score = $user->score + $exercise->score;
                $user->save();

            }

        }




    }

    public function testCode($languageId, $code, $stdin = null, $expected_output = null)
    {

        $response = Http::withHeaders([
            'x-rapidapi-key' => $this->token,
            'x-rapidapi-host' => $this->host
        ])->post('https://judge0.p.rapidapi.com/submissions', [
            'language_id' => $languageId,
            'source_code' => $code,
            'stdin' => $stdin,
            'expected_output' => $expected_output,
        ]);
        $submissionKey = $response['token'];

        for ($i = 0; $i < 4; $i++)
        {

            sleep(3);

            $response = Http::withHeaders([
                'x-rapidapi-key' => $this->token,
                'x-rapidapi-host' => $this->host
            ])->get('https://judge0.p.rapidapi.com/submissions/' . $submissionKey . '?base64_encoded=true');

            if ($response['status']['description'] == 'Accepted') {

                return array('accepted', $response->json());

            }

        }

        return array('timed-out', $response->json());

    }
}
