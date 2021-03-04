@extends('adminlte::page')

@section('title', 'Exercises')

@section('content_header')

    <div class="row justify-content-between">

        <div class="row justify-content-between PPS-page-title">
            <div>Uzdevumi</div>
        </div>

        <!--directive to check if user is admin - create exercise-->
        <div class="col-2 ">
            @can('create', \App\Models\exercise::class)
                <button type="button" class=" btn btn-block PPS-add-button btn-sm"
                        onclick="location.href='/exercises/create'">
                    Izveidot jaunu uzdevumu
                </button>
            @endcan
        </div>

    </div>


@stop


@section('content')

    <!--Layout of exercise search data-->


    <div class="container-fluid" >
        @if ($errors->has('q'))
            <strong style="color: white">Lūdzu ierakstiet, ko vēlaties meklēt</strong>
        @endif
            <form action="/exercises/search" class="w-100 justify-content-center" >
                <div class="input-group row w-100" style="margin: 0;">
                    <input type="search" class="form-control" placeholder="Meklēt pēc nosaukuma"
                           name="q"/>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary PPS-info-button" style="margin: 0; " type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>



            <div class="row justify-content-around align-items-center text-center PPS-content-header p-2" style="font-size: 25px">
                <div class="col-2" >Uzdevuma kods</div>
                <div class="col-3" >Nosaukums</div>
                <div class="col-2" >Veiksmīgi atrisinājumi</div>
                <div class="col-1">Iesūtījumi</div>
                <div class="col-1 ">Atrisinājumi</div>
                <div class="col-2 ">Tagi</div>
            </div>


    <!--Create and show exercises-->
    <div class="container-fluid w-100">
    @foreach($exercises as $exercise)
        <div class="row justify-content-between align-items-center text-center PPS-content-wrapper"
             >

            <div class="col-2" >{{$exercise->kods}}</div>
            <div class="col-3" >
                <a class="nav-link"
                   href="/exercises/show/{{$exercise->id}}">{{$exercise->nosaukums}}
                </a>
            </div>

            <div class="col-2 row align-items-center justify-content-center">
                <div class="col-8 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-green"
                             role="progressbar"
                             aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                             style="width:
                             {{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                               round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                             : 0}}%">

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
                    <span class="badge" style="background: {{$tag->color}}; color: black">
                        {{$tag->name}}
                        </span>
                @endforeach
            </div>

            <div class="col-2">
                @can('create', $exercise)
                    <div class="row">
                        <div>
                            <button type="button" class="btn-block btn PPS-delete-button btn-xs"
                                    onclick="location.href='exercises/del/{{$exercise->id}}'">
                                Dzēst uzdevumu
                            </button>
                        </div>
                        <div>
                            <button type="button" class="btn-block btn PPS-edit-button btn-xs"
                                    onclick="location.href='exercises/{{$exercise->id}}/edit'">
                                Labot uzdevumu
                            </button>
                        </div>
                    </div>
                @endcan
            </div>
        </div>

    @endforeach
    </div>
    </div>


@stop



