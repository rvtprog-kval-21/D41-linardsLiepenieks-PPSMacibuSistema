@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

    <div>Admin panelis/Banera bildes</div>
    </div>
@stop


@section('content')
    <div id="app">

        <form
            enctype="multipart/form-data"
            method="post">
            @csrf
            <banner-edit :old-images ="{{$bannerImage}}"></banner-edit>
        </form>
    </div>
@stop



