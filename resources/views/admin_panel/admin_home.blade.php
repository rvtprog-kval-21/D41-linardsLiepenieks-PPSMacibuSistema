@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

    <h1>Admin panelis</h1>
    <h4>Labdien, {{\Illuminate\Support\Facades\Auth::user()->name}}</h4>
@stop


@section('content')
    <div class="row justify-content-around">
        <div class="col-5" style="border: 1px solid black">
            <div style="font-size: 35px">
                <b>Palikuši testi:</b>
                {{$tests}}
            </div>
        </div>
        <div class="col-5">
            <button type="button" class="w-100 btn btn-block btn-warning btn-sm"
                    onclick="location.href='/admin/banner'">
                Rediģēt banera bildes
            </button>
            <button type="button" class="w-100 btn btn-block btn-warning btn-sm"
                    onclick="location.href='/admin/tags'">
                Rediģēt tagus
            </button>
        </div>
    </div>



@stop



