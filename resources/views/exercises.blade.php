@extends('adminlte::page')

@section('title', 'Uzdevumi')

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


    <div id="app">



        <exercise-search :exercises="{{$exercises}}"
        :solutions="{{\App\Models\Solution::All()}}" :submissions="{{\App\Models\Submission::All()}}"
        :exercise_tags="{{DB::table('exercise_tag')->get()}}"
        :tags="{{\App\Models\Tag::All()}}"></exercise-search>


        <!-- Vecs kods - viss šis pārnests uz VUE comp., lai dinamiski meklētu
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
                                     role="progressbar"
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


        @endforeach --->
    </div>


@stop



