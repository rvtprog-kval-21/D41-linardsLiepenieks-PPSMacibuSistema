@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')

    <h1>Admin panelis/Tagi</h1>
@stop


@section('content')
    <div id="app">
        <form action="/admin/tags"  enctype="multipart/form-data" method="post">
            @csrf
        <add-tag :old-tags="{{$oldTags}}"></add-tag>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
    </div>
@stop



