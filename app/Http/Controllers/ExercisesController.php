<?php

namespace App\Http\Controllers;

use App\Events\NewSubmissionSentEvent;
use App\Models\exercise;
use App\Models\Solution;
use App\Models\Submission;
use App\Models\Tag;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;


class ExercisesController extends Controller
{
    //
    public function __construct()
    {
    }

    public function index()
    {
        $exercises = Exercise::all();
        return view('exercises', compact('exercises'));
    }

    public function search(Request $request)
    {

        $exercises = Exercise::Where('nosaukums', 'like', '%' . $request->input('q') . '%')->get();
        return view('exercises', compact('exercises'));

    }

    public function create(User $user)
    {
        $this->authorize('create', Exercise::class);
        $tags = Tag::all();
        return view('exercises/create', compact('tags'));
    }

    public function show(\App\Models\exercise $exercise)
    {

        return view('exercises/show', compact('exercise'));
    }

    public function openSend(\App\Models\exercise $exercise)
    {
        if (Auth::user() == null) {
            return redirect('/login');
        } else
            return view('exercises/send', compact('exercise'));
    }

    public function submissions(\App\Models\exercise $exercise)
    {
        $submissions = Submission::Where('user_id', Auth::id())->Where('exercise_id', $exercise->id)->get()->sortByDesc('created_at');
        return view('exercises/submissions', compact('exercise', 'submissions'));
    }

    public function solutions(\App\Models\exercise $exercise)
    {
        $solutions = Solution::Where('user_id', Auth::id())->Where('exercise_id', $exercise->id)->get();
        return view('exercises/solutions', compact('exercise', 'solutions'));
    }

    public function edit(\App\Models\exercise $exercise)
    {
        $this->authorize('create', Exercise::class);
        $tags = Tag::all();
        return view('exercises/edit', compact('exercise', 'tags'));
    }

    public function send(\App\Models\exercise $exercise)
    {
        $this->middleware('auth');

        $submission = request()->validate([ //Validate codeMirror input
            'mode' => 'required',
            'code' => 'required',
        ]);

        //Prepare submission to be sent
        $send = new Submission(); //Create a new submission object
        $send->mode = $submission['mode']; //Add compiler mode (language)
        $send->code = $submission['code']; //Add user input Code
        $send->exercise_id = $exercise->id; //Connect submission instance to exercise
        $send->user_id = Auth::id();       //Connect Submission instance to current user
        $send->save();                     //Save the submission to database

        event(new NewSubmissionSentEvent($send, $exercise, Auth::user()));

        return redirect('/exercises');

    }


    public function store(Request $request, Exercise $exercise)
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
            'score' => 'required',
            'tags' => ''

        ]);

        $tests = request()->validate([

            'tests' => 'required|array',

        ]);

        if ($data['tags'] ?? null) {
            $tags = $data['tags'];
        }


        $exercise = \App\Models\exercise::create([
            'kods' => $data['kods'],
            'nosaukums' => $data['nosaukums'],
            'ievaddati' => $data['ievaddati'],
            'izvaddati' => $data['izvaddati'],
            'definicija' => $data['definicija'],
            'memory' => $data['memory'],
            'time' => $data['time'],
            'score' => $data['score'],
        ]);
        if ($data['tags'] ?? null) {

            foreach ($tags as $tag) {
                $exercise->tag()->attach(Tag::find($tag));
            }
        }
        for ($i = 0; $i < count($request->input('tests.stdin')); $i++) {
            $show = false;

            if ($request->input('tests.show.' . $i) == "on") {
                $show = true;
            }
            $exercise->tests()->create([
                //nocrashos ja stdin/stdout bus tukss
                'stdin' => $request->input('tests.stdin.' . $i),
                'stdout' => $request->input('tests.stdout.' . $i),
                'show' => $show
            ]);
        }
        return redirect('/exercises');
    }

    public function update(Request $request, Exercise $exercise)
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
            'score' => 'required',
            'tags' => ''

        ]);

        $tests = request()->validate([

            'tests' => 'required|array',

        ]);

        $exercise->tag()->detach();
        if ($data['tags'] ?? null) {
            $tags = $data['tags'];
            foreach ($tags as $tag) {
                $exercise->tag()->attach(Tag::find($tag));
            }
        }
        $exercise->update([
            'kods' => $data['kods'],
            'nosaukums' => $data['nosaukums'],
            'ievaddati' => $data['ievaddati'],
            'izvaddati' => $data['izvaddati'],
            'definicija' => $data['definicija'],
            'memory' => $data['memory'],
            'time' => $data['time'],
            'score' => $data['score'],
        ]);


        $exercise->tests()->delete();
        for ($i = 0; $i < count($request->input('tests.stdin')); $i++) {
            $show = false;
            if ($request->input('tests.show.' . $i) != null) {
                $show = true;
            }
            $exercise->tests()->create([
                //nocrashos ja stdin/stdout bus tukss
                'stdin' => $request->input('tests.stdin.' . $i),
                'stdout' => $request->input('tests.stdout.' . $i),
                'show' => $show
            ]);
        }
        return redirect('/exercises');
    }

    public function delete(\App\Models\exercise $exercise)
    {
        $this->authorize('create', Exercise::class);
        $exercise->tests()->delete();
        $exercise->submission()->delete();
        $exercise->tag()->detach();
        $exercise->delete();
        return redirect('/exercises');
    }


}
