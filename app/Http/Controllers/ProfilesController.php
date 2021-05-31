<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Submission;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;


class ProfilesController extends Controller
{
    public function index()
    {
        $this->middleware('auth');

        $user = Auth::user();
        //SELECT * FROM submission
        // WHERE exercise_id =
        // (SELECT id FROM exercise WHERE DOES NOT HAVE solution)
        //dd($user->solution()->get());

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
        $solved = $user->solution()
            ->join('exercises', 'solutions.exercise_id', 'exercises.id')
            ->get()->pluck('exercise');
        //dd($unsolved);

        //dd($user->submission()->orderBy('created_at')->get());

        return view('profile/profile_home', compact('unsolved', 'solved'))->with('user', $user);
    }

    public function show(User $user)
    {
        $this->middleware('auth');
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
        $solved = $user->solution()
            ->join('exercises', 'solutions.exercise_id', 'exercises.id')
            ->get()->pluck('exercise');

        return view('profile/profile_home', compact('unsolved', 'solved'))->with('user', $user);
    }
    public function edit()
    {
        $this->middleware('auth');
        $user= Auth::user();
        return view('profile/profile_edit', compact('user'));
    }

    public function update(Response $response, User $user)
    {
        $this->middleware('auth');
        $profile = $user->profile()->first();

        $data = request()->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password'=>'',
            'rpassword'=>'',


        ]);


        if($data['name']!==$user->name)
        {
            $user->name = $data['name'];
        }
        if($data['username']!==$profile->username)
        {
            $profile->username = $data['username'];
        }
        if($data['email']!==$user->email)
        {
            $user->email = $data['email'];
        }

        if($data['password'] !== null)
        {
            if($data['password'] === $data['rpassword'])
            {
                $user->update(['password'=> Hash::make($data['password'])]);
            }
            else
            {
                //dd(Redirect::back()->withErrors('password'));
                return Redirect::back()->withErrors(['password' => ['Paroles nesakrīt']]);

            }
        }
        //dd($profile);
        $user->save();
        $profile->save();

        return ProfilesController::index();
    }
}
