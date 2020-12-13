@extends('adminlte::page')

@section('title', 'Jaunumi')

@section('content_header')

    <div class="row justify-content-between">
        <h1>Jaunumi</h1>
    </div>

    <div class="row justify-content-center" style="height: 20vh; border: 1px solid black;">
        <img style="max-height: 100%;" src="{{asset('banner_images/banner-placeholder.png')}}"/>
    </div>

    @can('create', \App\Models\exercise::class)
        <button type="button" class=" btn btn-block btn-success btn-sm" onclick="location.href='/news/create'">
            Izveidot jaunu ierakstu
        </button>
    @endcan

@stop

@section('content')
    <div class="row justify-content-around">
        @foreach($news as $news)
        <div id="module" class="container col-5 m-2" style="border: 1px solid black; min-height: 25vh; padding: 0">
                <!--<div class="col-5" style="border: 1px solid black; height: 25vh; padding: 0;">-->

                <div class="p-1" style="background-color: dimgray; color: white";>{{$news->nosaukums}}</div>
                <div class="p-1" style="border-bottom: 2px solid black;"><div><b>Datums:</b> {{$news->created_at}}</div></div>

                <p class="collapse p-1" id="collapseExample" aria-expanded="false" >
                    {{$news->apraksts}}
                </p>
                <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample"></a>
                <div style="background-color: lightgray;" class="p-1"><b>Izveidoja:</b> {{$news->user->name}} </div>


            @can('create', \App\Models\exercise::class)
                <button type="button" class="btn-block btn btn-danger btn-xs" onclick="location.href='news/del/{{$news->id}}'">
                    Dzēst Ierakstu
                </button>
            @endcan
        </div>

        @endforeach






    </div>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="{{'css/read_more.css'}}">
@stop


