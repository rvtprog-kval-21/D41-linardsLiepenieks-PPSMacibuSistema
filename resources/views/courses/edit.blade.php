@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Izveidot jaunu kursu</div>
    </div>
@stop


@section('content')


    <div class="box box-primary">
        <div class="box-header with-border">

            <form action="/courses/{{$course->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body" style="font-size: 20px;">
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Kursa nosaukums</label>
                                <input class="form-control" type="text"
                                       id="name"
                                       name="name"
                                       maxlength="256"
                                       value="{{old('name') ?? $course->name}}"
                                >
                                @if ($errors->has('name'))
                                    <strong style="font-size: 15px;">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px">Kursa apraksts</label>

                                <div id="app">
                                    <editor></editor>
                                </div>
                                <textarea class="form-control" type="text"
                                          id="apraksts"
                                          name="apraksts"
                                >

                                    {{old('apraksts') ?? $course->desc}}</textarea>

                                @if ($errors->has('apraksts'))
                                    <strong style="font-size: 15px;">{{$errors->first('apraksts')}}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Tēma</label>
                                <input class="form-control" type="text"
                                       id="topic"
                                       name="topic"
                                       value="{{old('topic') ?? $course->topic}}"

                                >
                                @if ($errors->has('topic'))
                                    <strong style="font-size: 15px;">{{ $errors->first('topic') }}</strong>
                                @endif
                            </div>

                            <div class="row justify-content-between mb-2">
                                <div>
                                    <label style="font-size: 20px;">Publisks</label>
                                    <input class="form-control" type="checkbox"
                                           id="private"
                                           name="private"
                                           value="1"
                                        {{$course->private ? 'checked': ''}}>
                                </div>
                                <div>
                                    <label style="font-size: 20px;">Spotlight</label>
                                    <input class="form-control" type="checkbox"
                                           id="Spotlight"
                                           name="Spotlight"
                                           value="1"
                                        {{$course->spotlight ? 'checked': ''}}>
                                </div>
                                <div>
                                    <label style="font-size: 20px;">Redzams</label>
                                    <input class="form-control" type="checkbox"
                                           id="show"
                                           name="show"
                                           value="1"
                                        {{$course->show ? 'checked': ''}}>
                                </div>
                            </div>


                            <div>
                                <button type="submit" class="btn PPS-info-button">Saglabāt</button>
                            </div>
                            <div class="box-footer">
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>


@stop



