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
    @if ($errors->has('q'))
        <strong style="color: white">Lūdzu ierakstiet, ko vēlaties meklēt</strong>
    @endif

    <div class="w-100">

        <form action="/exercises/search">
            <div class="input-group row m-0">
                <input type="search" class="form-control" placeholder="Meklēt pēc nosaukuma"
                       name="q"/>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-outline-secondary PPS-info-button m-0"
                            type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>


        <div class="row PPS-content-header text-center align-items-center p-2 rounded"
             style="margin: 10px 0px 10px 0px;">
            <div class="col">Uzdevuma kods</div>
            <div class="col">Nosaukums</div>
            <div class="col">Veiksmīgi atrisinājumi</div>
            <div class="col">Iesūtījumi</div>
            <div class="col">Atrisinājumi</div>
            <div class="col">Tagi</div>
        </div>


        <!--Create and show exercises-->
        @foreach($exercises as $exercise)
            <a href="/exercises/show/{{$exercise->id}}">

                <div class="m-0 mb-2 p-2 row PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                     style="font-size: 1.5rem;
                            color: black;">

                    <div class="col">{{$exercise->kods}}</div>
                    <div class="col">
                        {{$exercise->nosaukums}}
                    </div>
                    <div class="col row align-items-center">
                        <div class="col-9 p-0">
                            <div class="progress" style="border: 1px solid black">
                                <div class="progress-bar"
                                     aria-valuemin="0"
                                     aria-valuemax="100"
                                     style="width:
                                     {{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                       round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%;">
                                </div>
                            </div>
                        </div>

                        <div class="col-2 p-1">{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%
                        </div>
                    </div>

                    <div
                        class="col">{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()}} </div>
                    <div class="col">{{\App\Models\Solution::Where('exercise_id', $exercise->id)->count()}}</div>

                    <div class="col">
                        @foreach($exercise->tag()->get() as $tag)
                            <span class="badge" style="background: {{$tag->color}}; color: black">
                        {{$tag->name}}
                        </span>
                        @endforeach
                    </div>
                </div>
            </a>

            <div class="col">
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
        @endforeach
    </div>


@stop



