@extends('adminlte::page')

@section('title', 'Exercises')

@section('content_header')

    <div class="row justify-content-between">
        <h1>Uzdevumi</h1>
        <div class="col-2 ">
            @can('create', \App\Models\exercise::class)
            <button type="button" class=" btn btn-block btn-success btn-sm" onclick="location.href='/exercises/create'">
                Izveidot jaunu uzdevumu
            </button>
            @endcan


        </div>
    </div>

    <div class="row justify-content-between align-items-center text-center" style="color:white; background-color: dimgray;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-2">Uzdevuma kods</div>
        <div class="col-3">Nosaukums</div>
        <div class="col-2">Veiksmīgi atrisinājumi</div>
        <div class="col-1">Iesūtījumi</div>
        <div class="col-1 ">Atrisinājumi</div>
        <div class="col-2 ">Tagi</div>
    </div>



@stop

@section('content')

    @foreach($exercises as $exercise)
        <div class="row justify-content-between align-items-center text-center" style="color:dimgray; background-color: white; border: 1px solid black;
                            font-size: 2vh;

                            margin-top: 5px; ">
            <div class="col-2">{{$exercise->kods}}</div>
            <div class="col-3"><a style="color: black" href="/exercises/show/{{$exercise->id}}">{{$exercise->nosaukums}}</a></div>
            <div class="col-2 row align-items-center">
                <div class="col-8 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-green " role="progressbar" aria-valuenow="40"
                             aria-valuemin="0" aria-valuemax="100" style="width: {{$exercise->iesutijumi>0 && $exercise->atrisinajumi>0 ? $exercise->iesutijumi/$exercise->atrisinajumi : 0}}%">
                            <span class="sr-only">40% Complete (success)</span>
                        </div>
                    </div>
                </div>
                <div class="col-1">{{$exercise->iesutijumi>0 && $exercise->atrisinajumi>0 ? $exercise->iesutijumi/$exercise->atrisinajumi : 0}}%</div>
        </div>
            <div class="col-1">{{$exercise->iesutijumi}} </div>
            <div class="col-1">{{$exercise->atrisinajumi}}</div>
            <div class="col-2 "><span class="badge bg-red">WIP</span></div>
        </div>
        <div class="col-2">
            @can('create', $exercise)
            <button type="button" class="btn-block btn btn-danger btn-xs" onclick="location.href='exercises/del/{{$exercise->id}}'">
                Dzēst uzdevumu
            </button>
                @endcan
        </div>
    @endforeach


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


