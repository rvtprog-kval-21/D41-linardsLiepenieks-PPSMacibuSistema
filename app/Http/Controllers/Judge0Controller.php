<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class Judge0Controller extends Controller
{
    protected $token = '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a';
    public function tests(Submission $submission, exercise $exercise)
    {

        /*$response = Http::withHeaders([
            'x-rapidapi-key' => '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a',
            'x-rapidapi-host' => 'judge0.p.rapidapi.com'
        ])->get('https://judge0.p.rapidapi.com/languages');*/

        dd($this->testCode(54, $submission->code));
    }

    public function testCode($languageId, $code, $stdin = null)
    {
        $response = Http::withHeaders([
            'x-rapidapi-key' => '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a',
            'x-rapidapi-host' => 'judge0.p.rapidapi.com'
        ])->post('https://judge0.p.rapidapi.com/submissions', [
            'language_id' => $languageId,
            'source_code' => $code,
            'stdin' =>  "world",
        ]);
        $submissionKey = $response['token'];
        $submissionKey = '323c5c1a-933b-4a77-9741-76c7749f02e6';


        $response = Http::withHeaders([
            'x-rapidapi-key' => '6e119475ebmsh65d847450b4e390p188601jsn33f056dec39a',
            'x-rapidapi-host' => 'judge0.p.rapidapi.com'
        ])->get('https://judge0.p.rapidapi.com/submissions/'.$submissionKey);
        return $response->json();
    }
}
