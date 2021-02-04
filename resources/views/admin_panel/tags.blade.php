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
            @if ($errors->has('newTags'))
                <strong>{{ $errors->first('newTags') }}</strong>
            @endif

        </form>
    </div>
@stop



