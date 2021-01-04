@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

    <h1>Admin panelis/Banera bildes</h1>
@stop


@section('content')
    <div id="app">
        <form action="/admin/banner/edit"
              enctype="multipart/form-data"
              method="post">
            @csrf
        <banner-edit></banner-edit>
            <div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@stop



