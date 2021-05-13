@extends('adminlte::page')
@section('title', 'Atrisinājumi')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Uzdevuma {{$exercise->kods}} atrisinājumi</div>
    </div>

    <!--Layout of submission data tooltips-->

@stop


@section('content')

    <!--Create submission objects-->
    <div id="app">
        <div class="container-fluid">

            <div class="row justify-content-around align-items-center text-center PPS-content-header p-2 m-2 rounded">
                <div class="col">Iesūtīts</div>
                <div class="col">Valoda</div>
                <div class="col">laiks</div>
                <div class="col">Atmiņa</div>
                <div class="col">Statuss</div>
                <div class="col">Testi</div>
            </div>
            <div class="justify-content-around align-items-center text-center p-2 m-2">

            @foreach($solutions as $submission)
            @php
                $submission = $submission->submission
            @endphp
            <a href="#" data-toggle="modal" data-target="#modal{{$submission->id}}">
                <div class="row justify-content-around text-center PPS-content-wrapper rounded">
                    <div class="col">{{$submission->created_at}}</div>
                    <div class="col">{{$submission->mode}}</div>
                    <div class="col">
                            {{$submission->submissionTest->sortBy('time')->first()->time ? $submission->submissionTest->sortBy('time')->first()->time : '----'}}
                    </div>
                    <div class="col">
                        {{$submission->submissionTest->sortBy('memory')->first()->memory ? $submission->submissionTest->sortBy('memory')->first()->memory : '----'}}
                    </div>
                    <div class="col">
                        {{$submission->submissionTest->sum('correct') == $exercise->tests->count() ? 'Pareizi' : 'Nepareizi'}}
                    </div>
                    <div class="col">
                        {{$submission->submissionTest->sum('correct')}} / {{$exercise->tests->count()}}
                    </div>
                </div>
            </a>

            <div id="modal{{$submission->id}}" class="modal fade container-fluid" role="dialog">
                <div class="modal-dialog modal-xl">

                    <!-- Modal content-->
                    <div class="modal-content PPS-content-wrapper text-left">
                        <div class="PPS-content-header p-3">
                            <span class="align-middle">{{$submission->created_at}}</span>
                            <button type="button" class="close nav-link" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <codemirror text-area-id="{{$submission->id}}"
                                        code="{{$submission->code}}"
                                        mode="{{$submission->mode}}"
                                        mode-id="mode{{$submission->id}}"
                                        timestamp="{{$submission->created_at}}"
                                        disabled="true">
                            </codemirror>

                            <div class="row justify-content-around mt-3 text-center">
                                <div class="col">#</div>
                                <div class="col">Laiks</div>
                                <div class="col">Atmiņa</div>
                                <div class="col-3">stdout</div>
                            </div>
                            @php $i = 1 @endphp
                            @foreach($submission->submissionTest as $try)
                                <div class="row justify-content-around mt-2 text-center"
                                     style="border: 3px solid {{$try->correct?'green':'red'}};
                                         border-radius:10px;">
                                    <div class="col align-self-center">{{$i}}</div>
                                    <div class="col align-self-center">{{$try->time != null ? $try->time: '---'}}s</div>
                                    <div class="col align-self-center">{{$try->memory}} mb</div>
                                    <div class="col-3 overflow-auto align-self-center" style="white-space: pre-line;">{{$try->stdout != null ? $try->stdout: '---'}}</div>
                                </div>
                                @php  $i++ @endphp
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
            </div>
        </div>
    </div>


@stop


@section('css')

    <link rel="stylesheet" href="{{'/css/codemirror.css'}}">

@stop




