@extends('adminlte::page')

@section('title', 'Reitings')

@section('content_header')


        <div class="row justify-content-between PPS-page-title">
            <div>Reitings</div>
        </div>

    <div class="row justify-content-between align-items-center text-center PPS-content-header" style="font-size: 20px">
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
    <div class="row justify-content-between align-items-center text-center PPS-content-wrapper p-2" style="font-size: 20px; margin: 5px">
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




