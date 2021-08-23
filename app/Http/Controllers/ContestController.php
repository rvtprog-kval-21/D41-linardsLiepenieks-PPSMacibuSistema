<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    public function index()
    {
        $createdContests = Contest::Where('user_id', '=', Auth::user()->id)->get();

        return view('/contests/show', compact('createdContests'));
    }
    public function create()
    {
        return view('/contests/create');
    }
    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'apraksts' => '',
            'type' => 'required',
            'exercises' => 'array',
            'private' => 'required',
            'minScore' => 'required'
        ]);


        $contest = Contest::create([
            'name' => $data['name'],
            'contestStart' => $data['startTime'],
            'contestEnd' => $data['endTime'],
            'desc' => $data['apraksts'],
            'private' => $data['private'],
            'type' => $data['type'],
            'minScore' => $data['minScore'],
            'user_id' => Auth::user()->id,


        ]);



        if ($data['exercises'] ?? null) {
            $exercises = $data['exercises'];
            foreach ($exercises as $exercise) {


                $contest->exercise()->attach(Exercise::find($exercise['id']));
                $contest->exercise()->find($exercise['id'])->update([
                    'scheduledExerciseTime' => $data['endTime'],
                    'scheduledContestExerciseTime' => $data['startTime'],

                ]);
            }
        }
    }

    public function delete(Contest $contest)
    {

        $contest->exercise()->detach();
        $contest->user()->detach();
        $contest->delete();
        return $this->index();
    }

    public function edit(Contest $contest)
    {
        $exercises = Exercise::All();
        return view('/contests/edit', compact('contest', 'exercises'));
    }

    public function update(Contest $contest)
    {
        $data = request()->validate([
            'name' => 'required',
            'startTime' => 'required',
            'endTime' => 'required',
            'apraksts' => '',
            'type' => 'required',
            'exercises' => 'array',
            'private' => 'required',
            'minScore' => 'required'
        ]);



        $contest->exercise()->detach();
        if ($data['exercises'] ?? null) {
            $exercises = $data['exercises'];
            foreach ($exercises as $exercise) {

                $contest->exercise()->attach(Exercise::find($exercise['id']));
                $contest->exercise()->find($exercise['id'])->update([
                    'scheduledExerciseTime' => $data['endTime'],
                    'scheduledContestExerciseTime' => $data['startTime'],

                ]);
            }
        }
        $contest->update([
            'name' => $data['name'],
            'contestStart' => $data['startTime'],
            'contestEnd' => $data['endTime'],
            'desc' => $data['apraksts'],
            'private' => $data['private'],
            'type' => $data['type'],
            'minScore' => $data['minScore'],
            'user_id' => Auth::user()->id,

        ]);
        return $data;
    }

    public function showContest(Contest $contest)
    {
        return view('contests/showContest', compact('contest'));
    }

    public function users(Contest $contest)
    {
        $users = $contest->user()->get();
        return view('contests/users', compact('contest', 'users'));
    }

    public function userEdit(Contest $contest)
    {
        $data = request()->validate([
            'users'=>'array'
        ]);

        $contest->user()->detach();

        if ($data['users'] ?? null) {
            $users = $data['users'];
            foreach ($users as $user) {

                $contest->user()->attach(User::find($user['id']));
            }
        }
        //return $data['users'];
    }
}
