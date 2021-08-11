<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Exercise;
use Illuminate\Support\Facades\Request;


class LessonController extends Controller
{
    public function create(Course $course)
    {
        $exercises = Exercise::All();
        return view('lessons/create', compact('course', 'exercises'));
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

                $lesson->exercises()->attach(Exercise::find($exercise['id'])->first());
            }
        }
        //return redirect('/courses/show/'.$course->id);



    }
}
