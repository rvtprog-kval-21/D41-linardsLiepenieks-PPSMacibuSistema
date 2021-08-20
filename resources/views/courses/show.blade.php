@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class=" justify-content-between PPS-page-title">
        <div class="mb-3 p-0">{{$course->name}}</div>
        <div class="p-2"><h3><em>{{$course->topic}}</em></h3></div>
    </div>
@stop


@section('content')
    <div id="app">
        @if($course->user_id != null)
            @if($course->user_id == \Illuminate\Support\Facades\Auth::user()->id && \Illuminate\Support\Facades\Auth::user()->teacher == 1)
                <div class="row">
                    <button type="button" class=" col-2 btn-block btn PPS-add-button btn-xs m-0"
                            onclick="location.href='/courses/{{$course->id}}/lessons/create'">
                        Pievienot nodarbību
                    </button>
                    <button type="button" class=" col-2 btn-block btn PPS-add-button btn-xs m-0"
                            onclick="location.href='/courses/{{$course->id}}/users'">
                        Pievienot dalībniekus
                    </button>
                    <button type="button" class=" col-2 btn-block btn PPS-info-button btn-xs m-0"
                            onclick="location.href='/courses/{{$course->id}}/users/exercises'">
                        Apskatīt dalībnieku izpildītos uzdevumus
                    </button>
                </div>
            @endif
        @endif
        <div class="PPS-content-wrapper d-flex justify-content-center" style="color: black;">
            <div class="col-8 p-4">
                {!! $course->desc !!}
            </div>
        </div>

        <div class="d-flex justify-content-center flex-wrap">


            @foreach($course->lessons()->orderBy('nr', 'asc')->get() as $lesson)

                <div class="PPS-content-wrapper col-7 m-2 rounded">

                    <div class="row justify-content-between PPS-content-heading text-center">
                        {{$lesson->name}}
                    </div>
                    <div class="row">
                        @if($course->user_id != null)
                            @if($course->user_id == \Illuminate\Support\Facades\Auth::user()->id && \Illuminate\Support\Facades\Auth::user()->teacher == 1)
                                <button type="button" class="col btn-block btn PPS-delete-button btn-xs m-0"
                                        onclick="location.href='/courses/{{$course->id}}/lessons/del/{{$lesson->id}}'">
                                    Dzēst nodarbību
                                </button>
                                <button type="button" class="col btn-block btn PPS-edit-button btn-xs m-0"
                                        onclick="location.href='/courses/{{$course->id}}/lessons/edit/{{$lesson->id}}'">
                                    Labot nodarbību
                                </button>
                            @endif
                        @endif
                    </div>
                    <div class="row" style="height: 25vh">
                        <div class="col-4 d-flex justify-content-center">
                            <img src="https://pps.lv/wp-content/uploads/2017/08/PPS-Logo_1-2.png" alt=""
                                 style="max-height: 25vh; max-width: 100%;">
                        </div>
                        <div class="col-8 p-2 overflow-auto" style="max-height: 25vh;">
                            {!! $lesson->desc !!}
                        </div>
                    </div>

                    <div id="accordion{{$lesson->id}}">
                        <div class="card">
                            <div class="card-header" id="heading{{$lesson->id}}">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse{{$lesson->id}}"
                                            aria-expanded="false" aria-controls="collapse{{$lesson->id}}">
                                        Nodarbības uzdevumi
                                    </button>
                                </h5>
                            </div>
                            <div id="collapse{{$lesson->id}}" class="collapse" aria-labelledby="heading{{$lesson->id}}"
                                 data-parent="#accordion{{$lesson->id}}">
                                <div class="card-body">
                                    <exercise-search
                                        :exercises="{{$lesson->exercises()->orderBy('difficulty', 'asc')->get()}}"
                                        :solutions="{{\App\Models\Solution::All()}}"
                                        :submissions="{{\App\Models\Submission::All()}}"
                                        :exercise_tags="{{DB::table('exercise_tag')->get()}}"
                                        :tags="{{\App\Models\Tag::All()}}"></exercise-search>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>


    </div>

@stop



