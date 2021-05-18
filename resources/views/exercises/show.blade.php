@extends('adminlte::page')
@section('title', 'Uzdevums')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Uzdevums: {{$exercise->nosaukums}}</div>
    </div>

    @if(!Auth::guest())
        <div class="row align-items-center d-table">
            <button type="button" class="btn PPS-info-button btn-lg  m-2 d-table-cell"
                    style="font-size: 2.5vh"
                    onclick="location.href='/exercises/{{$exercise->id}}/send'">Iesūtīt uzdevumu
            </button>
            <button type="button" class="btn  PPS-info-button btn-lg  m-2 d-table-cell"
                    style="font-size: 2.5vh"
                    onclick="location.href='/exercises/{{$exercise->id}}/submissions'">Mani iesūtījumi
            </button>
            <button type="button" class="btn  PPS-info-button btn-lg  m-2 d-table-cell"
                    style="font-size: 2.5vh"
                    onclick="location.href='/exercises/{{$exercise->id}}/solutions'">Mani atrisinājumi
            </button>
            @can('create', $exercise)
                <button type="button" class="btn PPS-delete-button btn-lg  m-2 d-table-cell"
                        onclick="window.location='/exercises/del/{{$exercise->id}}'">
                    Dzēst uzdevumu
                </button>
                <button type="button" class="btn PPS-edit-button btn-lg  m-2 d-table-cell"
                        onclick="window.location='/exercises/{{$exercise->id}}/edit'">
                    Labot uzdevumu
                </button>
            @endcan
        </div>
    @endif
@stop

@section('content')
    <div class="container-fluid p-0 rounded">
        <div class="justify-content-end p-3 PPS-content-header rounded">

            <div class="col">
                <div class="row">
                    <div class="mr-3 mb-2">Laika limits:</div>
                    <div>{{$exercise->time}} Sek.</div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="mr-3 mb-2">Atmiņas limits:</div>
                    <div>{{$exercise->memory}} MB</div>
                </div>
            </div>
            <div class="col">
                <div class="row align-items-center pb-2">
                    <div class="mr-3">Veiksmīgi atrisinājumi:</div>
                    <div class="row align-items-center">
                        <div style="min-width: 100px; margin-right: 5px; border: 1px solid black;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-green " role="progressbar"
                                     aria-valuemin="0"
                                     aria-valuemax="100"
                                     style="width: {{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%">
                                </div>
                            </div>
                        </div>
                        <div>{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100" style="border-bottom: 1px solid lightgray"></div>


        </div>
        <div class="p-3 PPS-content-wrapper rounded" style="color: black;">
            <h2 class="font-weight-bold" style="font-size: 4vh">Uzdevuma definīcija</h2>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->definicija}}</p>

            <h3 class="font-weight-bold">Ievaddatu raksturojums</h3>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->ievaddati}}</p>
            <h3 class="font-weight-bold">Izvaddatu raksturojums</h3>
            <p class="pb-1" style="border-bottom: 1px solid lightgray">{{$exercise->izvaddati}}</p>

            <h3 class="font-weight-bold">Testa piemēri:</h3>
            @php $i = 1@endphp
            @foreach($exercise->tests as $test)
                @if($test->show == true)

                    <div class="row justify-content-around align-items-center m-2">
                        <div class="col-1 font-weight-bold" style="font-size: 3vh">{{$i}}.</div>
                        <div class="col m-2 p-2 PPS-content-footer"
                             style="background-color:lightgray;
                             font-family: Monaco,monospace;
                             font-size: 2.5vh;
                             font-weight: 600;">
                            <span style="white-space: pre-line">{{$test->stdin}}</span>
                        </div>
                        <div class="col m-2 p-2 PPS-content-footer"
                             style="background-color:lightgray;
                             font-family: Monaco,monospace;
                             font-size: 2.5vh;
                             font-weight: 600;"><span style="white-space: pre-line">{{$test->stdout}}</span></div>
                    </div>
                    @php $i++@endphp

                @endif
            @endforeach
        </div>


    </div>
@stop


