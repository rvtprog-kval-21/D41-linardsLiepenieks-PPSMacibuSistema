@extends('adminlte::page')

@section('title', 'Jaunumi')

@section('content_header')

    <div class="row justify-content-between">
        <h1>Jaunumi</h1>
    </div>

    @can('create', \App\Models\exercise::class)
        <div class="flex-row-reverse d-flex">
        <button type="button" class="w-25 btn btn-block btn-warning btn-sm" onclick="location.href='/admin/banner'">
            Rediģēt banera bildes
        </button>
        </div>
    @endcan
    <div class="row justify-content-center">

        <div id="carouselExampleControls" class="carousel slide w-100" data-ride="carousel" style="background-color: black">
            <div class="carousel-inner text-center">
                @foreach($images as $key => $image)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}"
                        style="height: 50vh">
                        <img src="storage/{{$image->file_path}}" class="rounded mx-auto d-block"  alt="..."
                        style="height: 100%">
                    </div>
                @endforeach



                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
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
            <div id="module" class="container col-5 m-2"
                 style="border: 1px solid black; min-height: 25vh; padding: 0">
                <!--<div class="col-5" style="border: 1px solid black; height: 25vh; padding: 0;">-->

                <div class="p-1" style="background-color: dimgray; color: white" ;>{{$news->nosaukums}}</div>
                <div class="p-1" style="border-bottom: 2px solid black;">
                    <div><b>Datums:</b> {{$news->created_at}}</div>
                </div>

                <p class="collapse p-1" id="collapseExample" aria-expanded="false">
                    {{$news->apraksts}}
                </p>
                <a role="button" class="collapsed" data-toggle="collapse" href="#collapseExample"
                   aria-expanded="false" aria-controls="collapseExample"></a>
                <div style="background-color: lightgray;" class="p-1"><b>Izveidoja:</b> {{$news->user->name}}
                </div>


                @can('create', \App\Models\exercise::class)
                    <button type="button" class="btn-block btn btn-danger btn-xs"
                            onclick="location.href='news/del/{{$news->id}}'">
                        Dzēst Ierakstu
                    </button>
                @endcan
            </div>

        @endforeach


    </div>



@stop

@section('css')

    <link rel="stylesheet" href="{{'css/read_more.css'}}">
@stop


