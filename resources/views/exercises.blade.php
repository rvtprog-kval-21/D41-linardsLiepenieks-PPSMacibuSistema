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

    </div>

@stop



