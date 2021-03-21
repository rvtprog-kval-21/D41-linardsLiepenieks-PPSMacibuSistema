@extends('adminlte::page')
@section('title', 'Iesūtījumi')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

        <div>Uzdevuma {{$exercise->kods}} iesūtījumi</div>
    </div>

    <!--Layout of submission data tooltips-->

@stop


@section('content')

    <!--Create submission objects-->
    <div id="app">
        <div class="container-fluid">
            <div class="row justify-content-around align-items-center text-center PPS-content-header p-2"
                 style="font-size: 25px">
                <div class="col-2" >Iesūtīts</div>
                <div class="col-3" >Valoda</div>
                <div class="col-2" >laiks</div>
                <div class="col-1">Atmiņa</div>
                <div class="col-1 ">Statuss</div>
                <div class="col-2 ">Testi</div>
            </div>
            <div class="container-fluid w-100">

                @foreach($submissions as $submission)
                    <a href="#" data-toggle="modal" data-target="#modal{{$submission->id}}">
                        <div class="row justify-content-around text-center PPS-content-wrapper">
                            <div class="col-2" >{{$submission->created_at}}</div>
                            <div class="col-3" >{{$submission->mode}}</div>
                            <div class="col-2" >
                                    {{$submission->submissionTest->sortBy('time')->first() === null ? 'Gaida' : ($submission->submissionTest->sortBy('time')->first()->time ? $submission->submissionTest->sortBy('time')->first()->time : '----')}}
                            </div>
                            <div class="col-1">
                                {{$submission->submissionTest->sortBy('memory')->first() === null ? 'Gaida' : ($submission->submissionTest->sortBy('memory')->first()->memory ? $submission->submissionTest->sortBy('memory')->first()->memory : '----')}}
                            </div>
                            <div class="col-1">
                                {{$submission->submissionTest->sum('correct') == $exercise->tests->count() ? 'Pareizi' : 'Nepareizi'}}
                            </div>
                            <div class="col-2 ">
                                {{$submission->submissionTest->sum('correct')}} / {{$exercise->tests->count()}}
                            </div>
                        </div>
                    </a>

                    <div id="modal{{$submission->id}}" class="modal fade container-fluid" role="dialog">
                        <div class="modal-dialog modal-xl">

                            <!-- Modal content-->
                            <div class="modal-content PPS-content-wrapper">
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




