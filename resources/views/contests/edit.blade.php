@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Labot sacensības: "{{$contest->name}}"</div>
    </div>
@stop


@section('content')


    <div class="box box-primary" id="app">
        <div class="box-header with-border">

            @csrf

            <edit-contest
                name="exercises"
                id="exercises"
                :contest="{{$contest}}"
                :exercises="{{\App\Models\Exercise::all()}}"
                :contest-exercises="{{$contest->exercise()->get()}}"
            ></edit-contest>


        </div>
    </div>


@stop



