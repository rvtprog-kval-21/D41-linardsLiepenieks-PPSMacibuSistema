@extends('adminlte::page')

@section('title', 'Reitings')

@section('content_header')


    <div class="row justify-content-between PPS-page-title p-10">
        <div>Reitings</div>
    </div>




@stop

@section('content')
    <div>
        <div class="row PPS-content-header text-center align-items-center p-2 rounded"
             style="margin: 10px 0px 10px 0px;">
            <div class="col">#</div>
            <div class="col">Lietotājs</div>
            <div class="col">Risināti uzdevumi</div>
            <div class="col">Atrisināti uzdevumi</div>
            <div class="col ">Atrisinājumu reitings</div>
            <div class="col">Punkti</div>
            <div class="col">Sacensību reitings</div>
        </div>

        @foreach($rating as $rating)
            <a href="/profile/show/{{$rating->user->id}}">
                <div class="m-0 mb-2 p-2 row PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                     style="color: black;">
                    <div class="col">{{$loop->index+1}}.</div>
                    <div class="col">{{$rating->user->profile()->first()->username}}</div>
                    <div class="col">{{$rating->user->submission->unique('exercise_id')->count()}}</div>
                    <div class="col">{{$rating->user->solution->unique('exercise_id')->count()}}</div>
                    <div class="col ">{{$rating->user->submission->count()>0 && $rating->user->solution->count()>0 ?
                                    round($rating->user->solution->unique('exercise_id')->count() / $rating->user->submission->unique('exercise_id')->count(),2)*100
                                     : 0}}%
                    </div>
                    <div class="col ">{{$rating->score}}</div>
                    <div class="col ">{{DB::table('contest_submission')->where('user_id', '=', $rating->user->id)->groupBy('exercise_id')->get()->sum('score')}}</div>
                </div>
            </a>
        @endforeach

    </div>




@stop




