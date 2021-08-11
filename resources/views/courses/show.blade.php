@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class=" justify-content-between PPS-page-title">
        <div class="mb-3 p-0">{{$course->name}}</div>
        <div class="p-2"><h3><em>{{$course->topic}}</em></h3></div>
    </div>
@stop


@section('content')
    <div class="PPS-content-wrapper d-flex justify-content-center" style="color: black;">
        <div class="col-8 p-4">
        {!! $course->desc !!}
        </div>
    </div>

    @if($course->user_id == \Illuminate\Support\Facades\Auth::user()->id)
        <button type="button" class=" col-2 btn-block btn PPS-add-button btn-xs m-0"
                onclick="location.href='/courses/{{$course->id}}/lessons/create'">
            Pievienot nodarbību
        </button>
    @endif

    @foreach($course->lessons()->get() as $lesson)
    {{$lesson}}
        @foreach($lesson->exercises()->get() as $exercise)
            {{$exercise}}
        @endforeach
    @endforeach




@stop



