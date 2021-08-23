@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Izveidot jaunas sacensības</div>
    </div>
@stop


@section('content')


    <div class="box box-primary" id="app">
        <div class="box-header with-border">

            @csrf
            <create-contest
                name="exercises"
                id="exercises"
                :exercises="{{\App\Models\Exercise::all()}}"></create-contest>


        </div>
    </div>


@stop



