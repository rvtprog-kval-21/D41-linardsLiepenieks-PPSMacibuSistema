@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Profils</div>
        <div>Labdien, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
    </div>
@stop


@section('content')

    <div class="" id="app">
        <div class="container-fluid">
            <div class="w-50 row fex-nowrap">
                <h2>Neatrisinātie uzdevumi</h2>
                <exercise-search :exercises="{{$unsolved}}"
                                 :solutions="{{\App\Models\Solution::All()}}"
                                 :submissions="{{\App\Models\Submission::All()}}"
                                 :exercise_tags="{{DB::table('exercise_tag')->get()}}"
                                 :tags="{{\App\Models\Tag::All()}}"></exercise-search>
            </div>
        </div>
    </div>



@stop



