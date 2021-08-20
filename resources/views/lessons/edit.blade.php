@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Izveidot jaunu nodarbību, kursam {{$course->name}}</div>
    </div>
@stop


@section('content')


    <div class="box box-primary" id="app">
        <div class="box-header with-border">

            @csrf

            <edit-lesson
                name="exercises"
                id="exercises"
                :exercises="{{$exercises}}"
                :course="{{$course}}"
                :lesson="{{$lesson}}"
                :lesson-exercises="{{$lesson->exercises()->get()}}"
            ></edit-lesson>


        </div>
    </div>


@stop



