@extends('adminlte::page')

@section('title', 'Jaunumi')

@section('content_header')

    <div class="row justify-content-between PPS-page-title">
        <div>Jaunumi</div>
    </div>

    @can('create', \App\Models\exercise::class)
        <div class="flex-row-reverse d-flex">
        <button type="button" class="w-25 btn btn-block PPS-edit-button btn-sm" onclick="location.href='/admin/banner'">
            Rediģēt banera bildes
        </button>
        </div>
    @endcan
    <div class="row justify-content-center">

        <div id="carouselExampleControls" class="carousel slide w-100" data-ride="carousel" style="">
            <div class="carousel-inner text-center">
                @foreach($images as $key => $image)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}"
                        style="height: 50vh">
                        <img src="storage/{{$image->file_path}}" class="rounded mx-auto d-block"  alt="..."
                        style="height: 100%; border: 2px solid white;">
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
        <button type="button" class=" btn btn-block PPS-add-button btn-sm" onclick="location.href='/news/create'">
            Izveidot jaunu ierakstu
        </button>
    @endcan

@stop

@section('content')
    <div class="row justify-content-around">

        @foreach($news as $news)
            <div id="module" class=" col-5 PPS-content-wrapper"
                 >
                @can('create', \App\Models\exercise::class)
                    <button type="button" class="btn-block btn PPS-delete-button btn-xs"
                            onclick="location.href='news/del/{{$news->id}}'">
                        Dzēst Ierakstu
                    </button>
                @endcan

                <div style="height: 25vh;" class="overflow-hidden text-break ">
                <div class="p-1 PPS-content-header" >{{$news->nosaukums}}
                    <div><b>Datums:</b> {{$news->created_at}}</div>
                </div>

                        <p class="p-2 overflow-hidden" style="white-space: pre-line">{{$news->apraksts}}</p>
                </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn PPS-info-button" data-toggle="modal" data-target="#Modal{{$loop->index}}">
                        Lasīt rakstu
                    </button>

                    <!-- Modal -->
                    <div class="modal fade " id="Modal{{$loop->index}}" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="PPS-content-wrapper">
                                <div class="PPS-content-header p-3">
                                  <span class="align-middle">{{$news->nosaukums}}</span>
                                    <button type="button" class="close nav-link" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <table>
                                    <tr>
                                        <td>
                                <div class="p-3" style="white-space: pre-line;   word-break: break-word;">
                                    {{$news->apraksts}}
                                </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                <div  class="p-1 w-100 PPS-content-footer"><b>Izveidoja:</b> {{$news->user->name}}
                </div>



            </div>



        @endforeach


    </div>



@stop




