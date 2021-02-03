@extends('adminlte::page')

@section('title', 'Reitings')

@section('content_header')

    <div class="row justify-content-between">
        <h1>Reitings</h1>
    </div>
    <div class="row justify-content-between align-items-center text-center" style="color:white; background-color: dimgray;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-1">#</div>
        <div class="col-3">Lietotājs</div>
        <div class="col-2">Risināti uzdevumi</div>
        <div class="col-1">Atrisināti uzdevumi</div>
        <div class="col-1 ">Atrisinājumu reitings</div>
        <div class="col-1 ">Punkti</div>
    </div>


@stop

@section('content')
    @foreach($rating as $rating)
    <div class="row justify-content-between align-items-center text-center" style="color:black; background-color: white; border: 1px solid black; margin: 5px;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-1">{{$loop->index+1}}.</div>
        <div class="col-3">{{$rating->user->name}}</div>
        <div class="col-2">{{$rating->user->submission->unique('exercise_id')->count()}}</div>
        <div class="col-1">{{$rating->user->solution->unique('exercise_id')->count()}}</div>
        <div class="col-1 ">{{$rating->user->submission->count()>0 && $rating->user->solution->count()>0 ?
                                    round($rating->user->solution->unique('exercise_id')->count() / $rating->user->submission->unique('exercise_id')->count(),2)*100
                                     : 0}}%</div>
        <div class="col-1 ">{{$rating->score}}</div>
    </div>
@endforeach




@stop




