<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exercise;
use App\Models\Lesson;
use Illuminate\Support\Facades\Request;


class LessonController extends Controller
{
    public function create(Course $course)
    {
        $exercises = Exercise::All();
        return view('lessons/create', compact('course', 'exercises'));
    }
    public function edit(Course $course, Lesson $lesson)
    {
        $exercises = Exercise::All();
        return view('lessons/edit', compact('course', 'exercises', 'lesson'));
    }

    public function store(Course $course)
    {
        $data = request()->validate([
            'name' => 'required',
            'nr' => 'required',
            'apraksts' => 'required',
            'video' => '',
            'exercises' => 'array',
        ]);

        $lesson = $course->lessons()->create([
            'name' => $data['name'],
            'nr' => $data['nr'],
            'desc' => $data['apraksts'],

        ]);



        if ($data['exercises'] ?? null) {
            $exercises = $data['exercises'];
            foreach ($exercises as $exercise) {


                $lesson->exercises()->attach(Exercise::find($exercise['id']));
            }
        }
        //return redirect('/courses/show/'.$course->id);



    }
    public function update(Course $course, Lesson $lesson)
    {
        $data = request()->validate([
            'name' => 'required',
            'nr' => 'required',
            'apraksts' => 'required',
            'video' => '',
            'exercises' => 'array',
        ]);

        $lesson->exercises()->detach();
        if ($data['exercises'] ?? null) {
            $exercises = $data['exercises'];
            foreach ($exercises as $exercise) {

                $lesson->exercises()->attach(Exercise::find($exercise['id']));
            }
        }
        $lesson->update([
            'name' => $data['name'],
            'nr' => $data['nr'],
            'desc' => $data['apraksts'],

        ]);
        return $data;
    }
    public function  delete(Course $course,Lesson $lesson)
    {
        $lesson->exercises()->detach();
        $lesson->delete();
        return view('courses/show', compact('course'));

    }
}
