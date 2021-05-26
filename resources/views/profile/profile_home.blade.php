@extends('adminlte::page')

@section('title', 'Profils')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Profils</div>
        <div>Labdien, {{\Illuminate\Support\Facades\Auth::user()->name}}</div>
    </div>
@stop


@section('content')

    <div id="app">
        <div id="accordion" class="w-50">
            <div class="card">
                <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="true"
                                aria-controls="collapseOne">
                            Neatrisinātie uzdevumi
                        </button>
                    </h5>
                </div>

                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                    <div class="card-body">


                        <exercise-search :exercises="{{$unsolved}}"
                                         :solutions="{{\App\Models\Solution::All()}}"
                                         :submissions="{{\App\Models\Submission::All()}}"
                                         :exercise_tags="{{DB::table('exercise_tag')->get()}}"
                                         :tags="{{\App\Models\Tag::All()}}"></exercise-search>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                            Atrisinātie uzdevumi
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                    <div class="card-body">
                        <exercise-search :exercises="{{$solved}}"
                                         :solutions="{{\App\Models\Solution::All()}}"
                                         :submissions="{{\App\Models\Submission::All()}}"
                                         :exercise_tags="{{DB::table('exercise_tag')->get()}}"
                                         :tags="{{\App\Models\Tag::All()}}"></exercise-search>
                    </div>
                </div>
            </div>

        </div>


    </div>






@stop



