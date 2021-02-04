@extends('adminlte::page')

@section('title', 'Exercises')

@section('content_header')

    <div class="row justify-content-between">

        <h1>Uzdevumi</h1>

        <!--directive to check if user is admin - create exercise-->
        <div class="col-2 ">
            @can('create', \App\Models\exercise::class)
                <button type="button" class=" btn btn-block btn-success btn-sm"
                        onclick="location.href='/exercises/create'">
                    Izveidot jaunu uzdevumu
                </button>
            @endcan
        </div>

    </div>

    <!--Layout of exercise indo data-->
    <form action="exercises/search">
        <div class="input-group rounded">
            <input type="search" class="form-control rounded" placeholder="Search"
                   name="q"/>
            <span class="input-group-text border-0" id="search-addon">
    <button type="submit"><i class="fas fa-search"></i></button>
            </span>
        </div>
    </form>

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

    <!--Create and show exercises-->
    @foreach($exercises as $exercise)
        <div class="row justify-content-between align-items-center text-center"
             style="    color:dimgray;
                        background-color: white;
                        border: 1px solid black;
                        font-size: 2vh;
                        margin-top: 5px; ">

            <div class="col-2">{{$exercise->kods}}</div>
            <div class="col-3">
                <a style="color: black"
                   href="/exercises/show/{{$exercise->id}}">{{$exercise->nosaukums}}
                </a>
            </div>

            <div class="col-2 row align-items-center">
                <div class="col-8 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-green"
                             role="progressbar"
                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                             style="width:
                             {{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                               round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                             : 0}}%">

                            <!-- <span class="sr-only">40% Complete (success)</span>-->
                        </div>
                    </div>
                </div>

                <div class="col-1">{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%
                </div>
            </div>

            <div class="col-1">{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()}} </div>
            <div class="col-1">{{\App\Models\Solution::Where('exercise_id', $exercise->id)->count()}}</div>
            <div class="col-2 ">
                @foreach($exercise->tag()->get() as $tag)
                    <span class="badge" style="background: {{$tag->color}}">
                        {{$tag->name}}
                        </span>
                @endforeach
            </div>

            <div class="col-2">
                @can('create', $exercise)
                    <div class="row">
                        <div>
                            <button type="button" class="btn-block btn btn-danger btn-xs"
                                    onclick="location.href='exercises/del/{{$exercise->id}}'">
                                Dzēst uzdevumu
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn-block btn btn-warning btn-xs"
                                    onclick="location.href='exercises/{{$exercise->id}}/edit'">
                                Labot uzdevumu
                            </button>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

    @endforeach


@stop



