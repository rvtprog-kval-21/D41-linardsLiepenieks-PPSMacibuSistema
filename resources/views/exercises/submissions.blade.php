@extends('adminlte::page')
@section('title', 'Iesūtījumi')

@section('content_header')
    <h1>Uzdevuma {{$exercise->kods}} iesūtījumi</h1>

    <!--Layout of submission data tooltips-->
    <div class="row justify-content-between align-items-center text-center" style="color:white; background-color: dimgray;
                            font-size: 2vh;

                            margin-top: 5px; ">
        <div class="col-2">Iesūtīts</div>
        <div class="col-3">Valoda</div>
        <div class="col-2">laiks</div>
        <div class="col-1">Atmiņa</div>
        <div class="col-1 ">Statuss</div>
        <div class="col-2 ">Testi</div>
    </div>
@stop


@section('content')

    <!--Create submission objects-->
    <div id="app">

        @foreach($submissions as $submission)
            <a href="#" data-toggle="modal" data-target="#modal{{$submission->id}}">
                <div class="row justify-content-between align-items-center text-center" style="color:dimgray; background-color: white; border: 1px solid black;
                            font-size: 2vh;

                            margin-top: 5px; ">
                    <div class="col-2">{{$submission->created_at}}</div>
                    <div class="col-3">{{$submission->mode}}</div>
                    <div class="col-2 row align-items-center">
                        <div class="col-8 ">
                            {{$submission->submissionTest->sortBy('time')->first()->time ? $submission->submissionTest->sortBy('time')->first()->time : '----'}}
                        </div>
                    </div>
                    <div class="col-1">
                        {{$submission->submissionTest->sortBy('memory')->first()->memory ? $submission->submissionTest->sortBy('memory')->first()->memory : '----'}}
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
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>

                        <div class="modal-body">
                            <codemirror text-area-id="{{$submission->id}}"
                                        code="{{$submission->code}}"
                                        mode="{{$submission->mode}}"
                                        mode-id ="mode{{$submission->id}}"
                                        timestamp ="{{$submission->created_at}}"
                                        disabled ="true">
                            </codemirror>

                            <div class="row justify-content-around mt-3 text-center">
                                <div>#</div>
                                <div>Laiks</div>
                                <div>Atmiņa</div>
                                <div>stdout</div>
                            </div>
                            @php $i = 1 @endphp
                            @foreach($submission->submissionTest as $try)
                                <div class="row justify-content-around mt-2 text-center">
                                    <div>{{$i}}</div>
                                    <div>{{$try->time != null ? $try->time: '---'}}s</div>
                                    <div>{{$try->memory}} mb</div>
                                    <div>{{$try->stdout != null ? $try->stdout: '---'}}</div>
                                </div>
                                @php  $i++ @endphp
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        @endforeach
    </div>


@stop


@section('css')

    <link rel="stylesheet" href="{{'/css/codemirror.css'}}">

@stop




