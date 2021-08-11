<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use phpDocumentor\Reflection\Types\Compound;

class CoursesController extends Controller
{
    public function create(User $user)
    {
        $user = Auth::user();
        if (!Gate::allows('is-teacher', $user)) {
            abort(403);
        }


        return view('courses/create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => ['required', 'unique:courses'],
            'apraksts' => 'required',
            'topic' => 'required',
            'private' => '',
            'Spotlight' => '',
            'show' => '',
        ]);


        //dd($data);


        \App\Models\Course::create([

            'name' => $data['name'],
            'desc' => $data['apraksts'],
            'topic' => $data['topic'],
            'private' => $data['private'] ?? 0,
            'spotlight' => $data['Spotlight'] ?? 0,
            'show' => $data['show'] ?? 0,
            'user_id' => Auth::user()->id,

        ]);


        return redirect('/profile/courses');

    }

    public function delete(Course $course)
    {
        if ($course->user_id == Auth::user()->id || Auth::user()->admin == 1) {
            $course->delete();
            return redirect('/profile/courses');
        } else {
            abort(403);
        }

    }

    public function edit(Course $course)
    {
        if ($course->user_id == Auth::user()->id || Auth::user()->admin == 1) {
            return view('courses/edit', compact('course'));
        } else {
            abort(403);
        }
    }

    public function update(Course $course)
    {
        if ($course->user_id == Auth::user()->id || Auth::user()->admin == 1) {
            $data = request()->validate([
                'name' => ['required'],
                'apraksts' => 'required',
                'topic' => 'required',
                'private' => '',
                'Spotlight' => '',
                'show' => '',
            ]);

            $course->update([
                'name' => $data['name'],
                'desc' => $data['apraksts'],
                'topic' => $data['topic'],
                'private' => $data['private'] ?? 0,
                'spotlight' => $data['Spotlight'] ?? 0,
                'show' => $data['show'] ?? 0,
                'user_id' => Auth::user()->id,

            ]);

            return redirect('/profile/courses');

        } else {
            abort(403);
        }
    }

    public function show(Course $course)
    {
        return view('courses/show', compact('course'));
    }
}
