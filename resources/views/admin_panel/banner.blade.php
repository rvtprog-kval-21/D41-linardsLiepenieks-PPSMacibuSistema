@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

    <h1>Admin panelis/Banera bildes</h1>
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



