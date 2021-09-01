@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class=" justify-content-between PPS-page-title">
        <div class="mb-3 p-0">{{$contest->name}}</div>
        <div class="p-2"><h3><em>{{$contest->topic}}</em></h3></div>
    </div>
@stop


@section('content')
    <div id="app">
        <h1>Lietotāju iesūtījumi</h1>
        <div id="accordion" class="">
            @php
                $x = 0;
            @endphp
            @foreach($contest->user()->get() as $user)
                <div class="card">
                    <div class="card-header" id="heading{{$user->id}}">
                        <h5 class="mb-0">
                            <button class="btn btn-link justify-content-center" data-toggle="collapse"
                                    data-target="#collapse{{$user->id}}"
                                    aria-expanded="true"
                                    aria-controls="collapseOne">
                                {{$user->name}}

                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{$user->id}}" class="collapse" aria-labelledby="heading{{$user->id}}"
                         data-parent="#accordion">
                        <div class="card-body">


                            @foreach($contest->exercise()->get() as $exercise)
                                <div class="row p-1">
                                    <a href="/exercises/show/{{$exercise->id}}" class="col-6">
                                        <div
                                            class="m-0 p-2 row PPS-content-wrapper PPS-exercise text-center align-items-center rounded"
                                            style="background-color: white; color: black;">
                                            <div class="d-flex justify-content-center w-100">
                                                <div class="col">{{$exercise->kods}}</div>
                                                <div class="col">{{$exercise->nosaukums}}</div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="col-6">
                                        @php
                                            $submission = new \App\Models\Submission();
                                            if($exercise->submission()->where('user_id', '=', $user->id)->exists()){
                                            $solution = \App\Models\Solution::Where('user_id', $user->id)->Where('exercise_id', $exercise->id)->first();
                                            $submission = $exercise->submission()->where('user_id', '=', $user->id)->orderBy($exercise->submission()->first()->submissionTest()->where('correct', '=', 1)->count(), 'desc')->first();
                                            $submission->color = "yellow";
                                            }
                                            else
                                                {
                                                    $submission = null;
                                                    $solution = null;

                                                }


                                        @endphp
                                        @if($solution != null || $submission != null)

                                            @php
                                                if($solution){
                                                $submission = $solution->submission()->orderBy('time', 'asc')->first();
                                                    $submission->color = "darkseagreen";}
                                            @endphp

                                            <a href="#" data-toggle="modal"
                                               data-target="#modal{{$x}}">
                                                <div style="background-color: {{$submission->color}};"
                                                     class="row justify-content-around text-center PPS-content-wrapper rounded">
                                                    <div class="col">{{$submission->created_at}}</div>
                                                    <div class="col">{{$submission->mode}}</div>
                                                    <div class="col">
                                                        {{$submission->submissionTest->sortBy('time')->first() ? $submission->submissionTest->sortBy('time')->first()->time : '----'}}
                                                    </div>
                                                    <div class="col">
                                                        {{$submission->submissionTest->sortBy('memory')->first() ? $submission->submissionTest->sortBy('memory')->first()->memory : '----'}}
                                                    </div>
                                                    <div class="col">
                                                        {{$submission->submissionTest->sum('correct') == $exercise->tests->count() ? 'Pareizi' : 'Nepareizi'}}
                                                    </div>
                                                    <div class="col">
                                                        {{$submission->submissionTest->sum('correct')}}
                                                        / {{$exercise->tests->count()}}
                                                    </div>
                                                </div>
                                            </a>

                                            <div id="modal{{$x}}"
                                                 class="modal fade container-fluid" role="dialog">
                                                <div class="modal-dialog modal-xl">

                                                    <!-- Modal content-->
                                                    <div class="modal-content PPS-content-wrapper text-left">
                                                        <div class="PPS-content-header p-3">
                                                                    <span
                                                                        class="align-middle">{{$submission->created_at}}</span>
                                                            <button type="button" class="close nav-link"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <codemirror text-area-id="area{{$x}}"
                                                                        code="{{$submission->code}}"
                                                                        mode="{{$submission->mode}}"
                                                                        mode-id="mode{{$submission->id}}"
                                                                        timestamp="{{$submission->created_at}}"
                                                                        disabled="true">
                                                            </codemirror>

                                                            <div
                                                                class="row justify-content-around mt-3 text-center">
                                                                <div class="col">#</div>
                                                                <div class="col">Laiks</div>
                                                                <div class="col">Atmiņa</div>
                                                                <div class="col-3">stdout</div>
                                                            </div>
                                                            @php $i = 1 @endphp
                                                            @foreach($submission->submissionTest as $try)
                                                                <div
                                                                    class="row justify-content-around mt-2 text-center"
                                                                    style="border: 3px solid {{$try->correct?'green':'red'}};
                                                                        border-radius:10px;">
                                                                    <div
                                                                        class="col align-self-center">{{$i}}</div>
                                                                    <div
                                                                        class="col align-self-center">{{$try->time != null ? $try->time: '---'}}
                                                                        s
                                                                    </div>
                                                                    <div
                                                                        class="col align-self-center">{{$try->memory}}
                                                                        mb
                                                                    </div>
                                                                    <div
                                                                        class="col-3 overflow-auto align-self-center"
                                                                        style="white-space: pre-line;">{{$try->stdout != null ? $try->stdout: '---'}}</div>
                                                                </div>
                                                                @php  $i++ @endphp
                                                            @endforeach
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                            @php
                                                $x++;
                                            @endphp
                                        @else
                                            <div style="background-color: red; color: white;"
                                                 class="row justify-content-around text-center PPS-content-wrapper rounded">
                                                Uzdevums nav iesūtīts
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach

                    </div>


                </div>

@stop



