@extends('adminlte::page')
@section('title', 'Nosūtīt uzdevumu')

@section('content_header')
    <h1>Nosūtīt uzdevumu {{$exercise->kods}}</h1>
@stop
@section('content')
    <div id="app" class="row justify-content-center">
        <form action="/exercises/{{$exercise->id}}/send" enctype="multipart/form-data" method="post">
            @csrf
        <div style="width: 125vh;" >
            <codemirror></codemirror>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@stop
@section('css')

    <link rel="stylesheet" href="{{'/css/codemirror.css'}}">

@stop
@section('js')

@stop





