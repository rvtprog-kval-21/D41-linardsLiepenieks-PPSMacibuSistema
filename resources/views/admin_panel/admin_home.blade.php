@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Admin panelis</div>
        <div>Labdien, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
    </div>
@stop


@section('content')
    <div class="row justify-content-around ">
        <div class="col-5 PPS-content-wrapper">
            <div style="font-size: 35px">
                <b>Palikuši testi:</b>
                {{$tests}}
            </div>
            <div style="font-size: 35px">
                <b>Palikuši Uzdevumi:</b>
                {{$batch}}
            </div>
        </div>
        <div class="col-5">
            <button type="button" class="w-100 btn btn-block PPS-edit-button btn-sm"
                    onclick="location.href='/admin/banner'">
                Rediģēt banera bildes
            </button>
            <button type="button" class="w-100 btn btn-block PPS-edit-button btn-sm"
                    onclick="location.href='/admin/tags'">
                Rediģēt tagus
            </button>
            <button type="button" class="w-100 btn btn-block PPS-edit-button btn-sm"
                    onclick="location.href='/admin/users'">
                Rediģēt lietotāju privilēģijas
            </button>
        </div>
    </div>



@stop



