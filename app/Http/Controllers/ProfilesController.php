<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


class ProfilesController extends Controller
{
    public function index()
    {
        $this->middleware('auth');

        $user = Auth::user();
        //SELECT * FROM submission
        // WHERE exercise_id =
        // (SELECT id FROM exercise WHERE DOES NOT HAVE solution)
        $solutions = $user->solution()->get();
        $submissions = $user->submission()
            ->join('exercises', 'submissions.exercise_id', '=', 'exercises.id')
            ->get();


        foreach ($solutions as $solution) {

            foreach ($submissions->where('exercise_id', $solution->exercise_id) as $key => $item) {
                $submissions->forget($key);
            }
        }
        $unsolved = $submissions->pluck('exercise');
        //dd($unsolved);

        return view('profile/profile_home', compact('unsolved'))->with('user', $user);
    }
}
