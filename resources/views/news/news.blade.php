@extends('adminlte::page')

@section('title', 'Jaunumi')

@section('content_header')

    <div class="row justify-content-between PPS-page-title">
        <div>Jaunumi</div>
    </div>

    @can('create', \App\Models\exercise::class)
        <div class="flex-row-reverse d-flex">
            <button type="button" class="w-25 btn btn-block PPS-edit-button btn-sm"
                    onclick="location.href='/admin/banner'">
                Rediģēt banera bildes
            </button>
        </div>
    @endcan

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height: 50vh; width: 100%;">
        <div class="carousel-inner center text-center " style="height: 100%; ">
            @foreach($images as $key => $image)
                <div class="carousel-item {{$key == 0 ? 'active' : '' }} ">
                    <img src="storage/{{$image->file_path}}"
                         class="rounded"
                         style="max-width: 100%; max-height: 50vh; text-shadow: 2px 2px 5px red;
">
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

    @can('create', \App\Models\exercise::class)
        <button type="button" class=" btn btn-block PPS-add-button btn-sm" onclick="location.href='/news/create'">
            Izveidot jaunu ierakstu
        </button>
    @endcan

@stop

@section('content')
    <div class="row justify-content-around">

        @foreach($news as $news)
            <div id="module" class=" col-5 PPS-content-wrapper"
                 style="border-radius: 10px 10px 5px 5px;
                        overflow: hidden;
                        width: 50%;
                        padding: 0px;
                        margin: 10px;">

                <div style="height: 25vh;" class="overflow-hidden text-break ">
                    <div class="PPS-content-heading"> {{$news->nosaukums}}</div>
                    <div class="p-1 PPS-content-header">
                        <div><b>Datums:</b> {{$news->created_at}}</div>
                    </div>
                    <div class="p-2 overflow-hidden" style="white-space: pre-line">{!!   $news->apraksts  !!}</div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn PPS-info-button" data-toggle="modal"
                        data-target="#Modal{{$loop->index}}">
                    Lasīt rakstu
                </button>

                <!-- Modal -->
                <div class="modal fade" id="Modal{{$loop->index}}" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="PPS-content-wrapper">
                            <div class="PPS-content-header p-3">
                                <span class="align-middle">{{$news->nosaukums}}</span>
                                <button type="button" class="close nav-link" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="p-3" style="white-space: pre-line;   word-break: break-word;">
                                {!! $news->apraksts!!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-1 PPS-content-footer"><b>Izveidoja:</b> {{$news->user->name}}
                </div>

                @can('create', \App\Models\exercise::class)
                    <button type="button" class="btn-block btn PPS-delete-button btn-xs"
                            onclick="location.href='news/del/{{$news->id}}'">
                        Dzēst Ierakstu
                    </button>
                @endcan
            </div>



        @endforeach


    </div>



@stop




