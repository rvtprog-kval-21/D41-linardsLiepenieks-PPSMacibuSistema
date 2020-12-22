<?php

namespace App\Http\Controllers;

use App\Models\exercise;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function openSend(\App\Models\exercise $exercise)
    {
        return view('exercises/send', compact('exercise'));
    }
    public function submissions(\App\Models\exercise $exercise)
    {
        $submissions = Submission::Where('user_id', Auth::id())->Where('exercise_id', $exercise->id)->get();
        return view('exercises/submissions', compact('exercise', 'submissions'));
    }
    public function send(\App\Models\exercise $exercise)
    {
        $this->middleware('auth');

        $submission = request()->validate([
            'mode' => 'required',
            'code' => 'required',
        ]);
        $send = new Submission();
        $send->mode = $submission['mode'];
        $send->code = $submission['code'];
        $send->exercise_id = $exercise->id;
        $send->user_id = Auth::id();

        $user_code = $send->code; //code ir kods no form ko ievada lietotajs

        $Judge = new Judge0Controller;
        $Judge->tests($send,$exercise);



        /*if($send->mode == "C++"){
            $filename = 'tests.cpp'; //save the name of the empty file
            $system = "g++ -o tests.cgi tests.cpp";
            $exec_file = "tests.cgi";
            system($system); //used the g++ compiler to create the an executable cgi file.

        }
        if($send->mode == "Python"){
            $filename = "tests.py";
            $exec_file = "tests.py";
        }
        if($send->mode == "Javascript"){
            $filename = "tests.html";
            $exec_file = "tests.html";
        }*/



        /*file_put_contents($filename, $user_code); //put content into the empty file
        $output = exec($exec_file);

        echo  $output;//execute the file

        //dd(file_put_contents($filename, $cpp_content));*/


        //$send->save();

        //$exercise->iesutijumi +=1;
        //$exercise->save();

        //return redirect('/exercises');

    }



    public function store(Request $request)
    {
        $this->authorize('create', Exercise::class);


        $exercise = request()->validate([
           'kods' => 'required',
           'nosaukums' => 'required',
           'ievaddati' => 'required',
           'izvaddati' => 'required',
           'definicija' => 'required',
            'memory' => 'required',
            'time' => 'required',

        ]);
        $tests = request()->validate([

            'tests' =>'required|array',

        ]);






        $exercise = \App\Models\exercise::create($exercise);

        for ($i = 0; $i < count($request->input('tests.stdin')); $i++) {
            $show = false;
            if($request->input('tests.show.'.$i) != null){
                $show = true;
                }
            $exercise->tests()->create([
                //nocrashos ja stdin/stdout bus tukss
                'stdin' => $request->input('tests.stdin.'.$i),
                'stdout'=>$request->input('tests.stdout.'.$i),
                'show'=>$show
            ]);
        }



        return redirect('/exercises');
    }

    public function delete(\App\Models\exercise $exercise)
    {


        $this->authorize('create', Exercise::class);
        $exercise->tests()->delete();
        $exercise->submission()->delete();
        $exercise->delete();
        return redirect('/exercises');
    }


}
