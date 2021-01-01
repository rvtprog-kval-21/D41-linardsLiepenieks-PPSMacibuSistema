@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1 style="font-size: 5vh">Uzdevums: <b>{{$exercise->nosaukums}}</b></h1>
    @if(!Auth::guest())
    <div class="row align-items-center">
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2" onclick="location.href='/exercises/{{$exercise->id}}/send'">Iesūtīt uzdevumu</button>
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2"onclick="location.href='/exercises/{{$exercise->id}}/submissions'" >Mani iesūtījumi</button>
        <button type="button" class="btn  btn-primary btn-lg col-2 m-2" onclick="location.href='/exercises/{{$exercise->id}}/solutions'">Mani atrisinājumi </button>

    </div>
    @endif
@stop
@section('content')

    <div class="row justify-content-center">
        <div class=" justify-content-end w-100 p-3" style="border: 1px solid black; background-color: white">
            <div class="col-5">
                <div class="row" style="font-size: 2vh; font-weight: 600;">
                    <div class="mr-1 mb-2">Laika limits:</div>
                    <div class="mr-1">{{$exercise->time}}</div>
                    <div>Sek.</div>
                </div>
            </div>
            <div class="col-5">
                <div class="row" style="font-size: 2vh; font-weight: 600;">
                    <div class="mr-1 mb-2">Atmiņas limits:</div>
                    <div class="mr-1">{{$exercise->memory}}</div>
                    <div>MB</div>
                </div>
            </div>
            <div class="col-5">
                <div class="row align-items-center pb-2 mb-4" style="font-size: 2vh; font-weight: 600; border-bottom: 1px solid lightgray">
                    <div class="mr-3">Veiksmīgi atrisinājumi:</div>
                    <div class="row align-items-center">
                        <div style="min-width: 100px; margin-right: 5px;">
                            <div class="progress">
                                <div class="progress-bar progress-bar-green " role="progressbar" aria-valuenow="40"
                                     aria-valuemin="0" aria-valuemax="100" style="width: {{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                        <div>{{\App\Models\Submission::Where('exercise_id', $exercise->id)->count()>0 && \App\Models\Solution::Where('exercise_id', $exercise->id)->count() ?
                                    round(\App\Models\Solution::Where('exercise_id', $exercise->id)->count() / \App\Models\Submission::Where('exercise_id', $exercise->id)->count(),2)*100
                                     : 0}}%</div>
                    </div>
                </div>


            </div>
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

                    <div class="row justify-content-around">
                        <div class="col-1 font-weight-bold" style="font-size: 3vh">{{$i}}.</div>
                        <div class="col-5 p-2" style="background-color:lightgray;border: 1px solid black; font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace; font-size: 2vh; font-weight: 600;">{{$test->stdin}}</div>
                        <div class="col-5 p-2" style="background-color:lightgray;border: 1px solid black; font-family: Courier New,Courier,Lucida Sans Typewriter,Lucida Typewriter,monospace; font-size: 2vh; font-weight: 600;">{{$test->stdout}}</div>
                    </div>
                    @php $i++@endphp

                @endif
                @endforeach

        </div>



    </div>


@stop


