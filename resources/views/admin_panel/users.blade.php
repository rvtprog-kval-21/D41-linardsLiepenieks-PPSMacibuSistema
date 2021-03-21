@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

    <div>Admin panelis/Lietotāji</div>
    </div>
@stop


@section('content')
    <div id="app">
        <div class="row PPS-content-header text-center" style="font-size: 25px">
            <div class="col">Lietotājvārds</div>
            <div class="col">Epasts</div>
            <div class="col-2">Admins</div>
            <div class="col-2">Skolotājs</div>
            <div class="col-1"><i class="fas fa-trash"></i></div>
        </div>

        <user-edit :users="{{$users}}"></user-edit>
    </div>
@stop



