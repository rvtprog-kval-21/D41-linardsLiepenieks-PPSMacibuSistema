<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use App\Models\User;
use Illuminate\Http\Request;

class ExercisesController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises', compact('exercises', 'exercises'));
    }

    public function create(User $user)
    {

        $this->authorize('create', Exercise::class);
        return view('exercises/create');
    }
    public function show(\App\Models\exercise $exercise)
    {

        return view('exercises/show', compact('exercise'));
    }

    public function store()
    {
        $this->authorize('create', Exercise::class);

        $data = request()->validate([
           'kods' => 'required',
           'nosaukums' => 'required',
           'ievaddati' => 'required',
           'izvaddati' => 'required',
           'definicija' => 'required',
            'memory' => 'required',
            'time' => 'required',



        ]);







        \App\Models\exercise::create($data);
        $exercises = exercise::all();

        return redirect('/exercises');
    }

    public function delete(\App\Models\exercise $exercise)
    {


        $this->authorize('create', Exercise::class);
        $exercise->delete();
        return redirect('/exercises');
    }


}
