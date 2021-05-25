<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $submissions = $user->submission()->groupBy('exercise_id')->get();
        dd($submissions);
        return view('profile/profile_home')->with('user', $user);
    }
}
