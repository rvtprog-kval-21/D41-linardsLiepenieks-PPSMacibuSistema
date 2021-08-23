@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class=" justify-content-between PPS-page-title">
        <div class="mb-3 p-0">{{$contest->name}}</div>
    </div>
@stop


@section('content')
    <div id="app">
        <h1>Pievienot lietotājus</h1>

        <add-user-to-course
        :users="{{\App\Models\User::all()}}"
        :course="{{$contest}}"
        :course-users="{{$users}}"
        :path="/contests/"></add-user-to-course>


    </div>

@stop



