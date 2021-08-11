@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Mani kursi</div>

        @if(\Illuminate\Support\Facades\Auth::user()->teacher == 1)

            <button type="button" class=" btn PPS-add-button btn-sm"
                    onclick="location.href='/courses/create'">
                Izveidot jaunu Kursu
            </button>

        @endif

    </div>
@stop


@section('content')
    <div class="m-0 justify-content-center">
        @if(\Illuminate\Support\Facades\Auth::user()->teacher == 1)


            <h2 class="mb-4" style="color: black;">Mani pārvaldāmie kursi</h2>



            <div class="d-flex justify-content-center flex-wrap">

                @foreach($createdCourses as $course)
                    <div
                        class="PPS-content-wrapper PPS-exercise overflow-hidden col-5" style="border-radius: 10px 10px 5px 5px;
                        width: 50%;
                        padding: 0px;
                        margin: 10px;
                        color: black;
                        height: 20rem;
text-overflow: ellipsis;
                                overflow: hidden;">
                        <div class="row justify-content-between PPS-content-heading text-center">
                            <div class="col-5"
                                 style="text-overflow: ellipsis;
                                overflow: hidden;">{{$course->name}}</div>
                            <div class="col-3" style="text-overflow: ellipsis;
                                overflow: hidden;"><em>{{$course->topic}}</em></div>
                            <div class="col-1"><i
                                    class="{{$course->private? 'fas fa-lock' : 'fas fa-lock-open'}}"></i>
                            </div>
                            <div class="col-1"><i class="{{$course->show? 'fas fa-eye' : 'fas fa-eye-slash'}}"></i>
                            </div>
                            <div class="col-1"><i
                                    class="{{$course->spotlight? 'fas fa-lightbulb' : 'far fa-lightbulb'}}"></i>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <button type="button" class="col-6 m-0 btn-block btn PPS-delete-button btn-xs"
                                        onclick="location.href='/courses/del/{{$course->id}}'">
                                    Dzēst kursu
                                </button>
                                <button type="button" class="col-6 m-0 btn-block btn PPS-edit-button btn-xs"
                                        onclick="location.href='/courses/edit/{{$course->id}}'">
                                    Labot kursu
                                </button>
                            </div>
                            <div class="p-3"><a style="color: black;"
                                                href="/courses/show/{{$course->id}}">{!! $course->desc !!}</a></div>
                            <button type="button" class="col m-0 btn-block btn PPS-info-button btn-xs position-absolute"
                                    style="bottom: 0;"
                                    onclick="location.href='/courses/show/{{$course->id}}'">
                                Apskatīt kursu
                            </button>
                        </div>
                    </div>

                @endforeach
            </div>
        @endif
    </div>



@stop



