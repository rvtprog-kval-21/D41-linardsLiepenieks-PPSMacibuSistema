@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

    <div>Admin panelis/Lietotāji</div>
    </div>
@stop


@section('content')
    <div id="app">
        <div class="row justify-content-around align-items-center text-center PPS-content-header p-2 m-2 rounded">
            <div class="col">Vārds</div>
            <div class="col-3">Epasts</div>
            <div class="col">Admins</div>
            <div class="col">Skolotājs</div>
            <div class="col-1"><i class="fas fa-trash"></i></div>
        </div>

        <user-edit :users="{{$users}}"></user-edit>
    </div>
@stop



