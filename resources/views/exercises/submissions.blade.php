@extends('adminlte::page')
@section('title', 'Atrisinājumi')

@section('content_header')
    <h1>Uzdevuma {{$exercise->kods}} atrisinājumi</h1>

    <div class="row justify-content-between align-items-center text-center" style="color:white; background-color: dimgray;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-2">Iesūtīts</div>
        <div class="col-3">Valoda</div>
        <div class="col-2">laiks</div>
        <div class="col-1">Atmiņa</div>
        <div class="col-1 ">Statuss</div>
        <div class="col-2 ">Testi</div>
    </div>
@stop
@section('content')



        @foreach($submissions as $submission)
            <a href="#" data-toggle="modal" data-target="#modal{{$submission->id}}">
            <div class="row justify-content-between align-items-center text-center" style="color:dimgray; background-color: white; border: 1px solid black;
                            font-size: 2vh;

                            margin-top: 5px; ">
                <div class="col-2">{{$submission->created_at}}</div>
                <div class="col-3">{{$submission->mode}}</div>
                <div class="col-2 row align-items-center">
                    <div class="col-8 ">
                        WIP
                    </div>
                </div>
                <div class="col-1">WIP </div>
                <div class="col-1">WIP</div>
                <div class="col-2 ">WIP</div>
            </div>
            </a>

            <div id="modal{{$submission->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            {{$submission->code}}
                        </div>

                    </div>

                </div>
            </div>
        @endforeach


@stop

@section('css')

    <link rel="stylesheet" href="{{'/css/codemirror.css'}}">

@stop



