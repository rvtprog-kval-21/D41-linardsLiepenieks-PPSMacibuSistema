@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1 style="font-size: 5vh">Uzdevums: <b>{{$exercise->nosaukums}}</b></h1>
    <div class="row align-items-center">
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2">Iesūtīt uzdevumu Wip</button>
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2">Mani iesūtījumi Wip</button>
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2">Mani atrisinājumi Wip</button>

    </div>
@stop
@section('content')

    <div class="row justify-content-center">
        <div class=" justify-content-end w-100 p-3" style="border: 1px solid black; background-color: white">
            <div class="col-5">
                <div class="row" style="font-size: 2vh; font-weight: 600;">
                    <div class="mr-1 mb-2">Laika limits:</div>
                    <div class="mr-1">{{$exercise->time}}</div>
                    <div>Sek.</div>
                </div>
            </div>
            <div class="col-5">
                <div class="row" style="font-size: 2vh; font-weight: 600;">
                    <div class="mr-1 mb-2">Atmiņas limits:</div>
                    <div class="mr-1">{{$exercise->memory}}</div>
                    <div>MB</div>
                </div>
            </div>
            <div class="col-5">
                <div class="row align-items-center pb-2 mb-4" style="font-size: 2vh; font-weight: 600; border-bottom: 1px solid lightgray">
                    <div class="mr-3">Veiksmīgi atrisinājumi:</div>
                    <div class="row align-items-center">
                        <div style="min-width: 100px; margin-right: 5px;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-green " role="progressbar" aria-valuenow="40"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{$exercise->iesutijumi>0 && $exercise->atrisinajumi>0 ? $exercise->iesutijumi/$exercise->atrisinajumi : 0}}%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                        <div>{{$exercise->iesutijumi>0 && $exercise->atrisinajumi>0 ? $exercise->iesutijumi/$exercise->atrisinajumi : 0}}%</div>
                    </div>
                </div>


            </div>
            <h2 class="font-weight-bold" style="font-size: 4vh">Uzdevuma definīcija</h2>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->definicija}}</p>

            <h3 class="font-weight-bold">Ievaddatu raksturojums</h3>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->ievaddati}}</p>
            <h3 class="font-weight-bold">Izvaddatu raksturojums</h3>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->izvaddati}}</p>
        </div>
    </div>


@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
