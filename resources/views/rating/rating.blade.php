@extends('adminlte::page')

@section('title', 'Reitings')

@section('content_header')

    <div class="row justify-content-between">
        <h1>Reitings</h1>
    </div>
    <div class="row justify-content-between align-items-center text-center" style="color:white; background-color: dimgray;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-1">#</div>
        <div class="col-3">Lietotājs</div>
        <div class="col-2">Risināti uzdevumi</div>
        <div class="col-1">Atrisināti uzdevumi</div>
        <div class="col-1 ">Atrisinājumu reitings</div>
        <div class="col-1 ">Punkti</div>
    </div>


@stop

@section('content')
    @foreach($rating as $rating)
    <div class="row justify-content-between align-items-center text-center" style="color:black; background-color: white; border: 1px solid black; margin: 5px
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-1">{{$loop->index+1}}.</div>
        <div class="col-3">{{$rating->user->name}}</div>
        <div class="col-2">Risināti uzdevumi WIP</div>
        <div class="col-1">Atrisināti uzdevumi WIP</div>
        <div class="col-1 ">Atrisinājumu reitings WIP</div>
        <div class="col-1 ">{{$rating->score}}</div>
    </div>
@endforeach




@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <script defer src="{{ asset('js/app.js') }}"></script>
@stop


