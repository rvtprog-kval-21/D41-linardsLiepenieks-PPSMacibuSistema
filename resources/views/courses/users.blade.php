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
        <h1>Pievienot lietotājus</h1>

        <add-user-to-course
        :users="{{\App\Models\User::all()}}"
        :course="{{$course}}"
        :course-users="{{$users}}"></add-user-to-course>


    </div>

@stop



