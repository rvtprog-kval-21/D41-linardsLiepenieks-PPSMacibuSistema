@extends('adminlte::page')

@section('title', 'Profils')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Profils</div>
        <div>Labdien, {{$user->name}}</div>
    </div>
@stop


@section('content')

    <div>
        @if(\Illuminate\Support\Facades\Auth::user() !== null)
        @if(\Illuminate\Support\Facades\Auth::user()->id === $user->id)
        <button class="ml-2 mb-0 PPS-edit-button"
                onclick="location.href='/profile/edit'">Labot profilu
        </button>
        @endif
        @endif
        <div class="row m-2">
            <div class="col  PPS-content-wrapper p-0 m-1">
                <div class="PPS-content-heading p-3">
                    <div class="row justify-content-between">
                        <div>{{$user->profile()->first()->username}} Statistika</div>
                        <div>Punkti: {{$user->profile()->first()->score}}</div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col">Uzdevumu reitings:</div>
                    <div class="col row align-items-center d-flex justify-content-end">
                        <div class="col">
                            <div class="progress" style="border: 1px solid black">
                                <div class="progress-bar"
                                     role="progressbar"
                                     aria-valuemin="0"
                                     aria-valuemax="100"
                                     style="width:
                                     {{$solved->count()>0||$unsolved->count()>0?round($solved->count()/($unsolved->count()+$solved->count())*100):0}}%;">
                                </div>
                            </div>
                        </div>

                        <div class="">
                            {{$solved->count()>0||$unsolved->count()>0?(round($solved->count()/($unsolved->count()+$solved->count())*100)) : 0}}
                            %
                        </div>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col">Veiksmīgi atrisināti uzdevumi</div>
                    <div class="col row align-items-center d-flex justify-content-end pr-4">
                        {{$solved->count()}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col">Neatrisināti uzdevumi</div>
                    <div class="col row align-items-center d-flex justify-content-end pr-4">
                        {{$unsolved->count()}}
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col">Punkti</div>
                    <div class="col row align-items-center d-flex justify-content-end pr-4">
                        {{$user->profile()->first()->score}}
                    </div>
                </div>
            </div>
            <div class="row col m-1">

                <div id="statisticsChart" class="w-100" style=""></div>


                <script>
                    new Morris.Line({
                        // ID of the element in which to draw the chart.
                        element: 'statisticsChart',
                        // Chart data records -- each entry in this array corresponds to a point on
                        // the chart.

                        data: [

                                @foreach($user->solution()->orderBy('created_at')->get() as $submission)

                            {
                                datums: '{{$submission->created_at}}',
                                a: {{$user->solution()->where('created_at','<=',$submission->created_at)->count()}},
                            },

                            @endforeach

                            //{ datums: '2009', value: 10 },


                        ],
                        // The name of the data record attribute that contains x-values.
                        xkey: 'datums',

                        // A list of names of data record attributes that contain y-values.
                        stacked: true,

                        ykeys: ['a'],
                        // Labels for the ykeys -- will be displayed when you hover over the
                        // chart.
                        labels: ['Atrisinājumi:'],
                    });

                </script>
            </div>

        </div>

        <div id="app">
            <div id="accordion" class="">
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


    </div>






@stop



