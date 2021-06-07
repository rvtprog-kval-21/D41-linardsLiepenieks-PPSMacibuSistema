@extends('adminlte::page')
@section('title', 'Izveidot uzdevumu')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
    <div>Izveidot jaunu Uzdevumu</div>
    </div>
@stop
@section('content')

    <div class="box box-primary" id="app">
        <div class="box-header with-border">
            <!-- /.box-header -->
            <!-- form start -->
            <add-polygon></add-polygon>
            <form action="/exercises/post" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body" style="font-size: 20px;">
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Uzdevuma kods</label>
                                <input class="form-control" type="text"
                                       id="kods"
                                       name="kods"
                                       maxlength="64"
                                       value="{{old('kods')}}"
                                >
                                @if ($errors->has('kods'))
                                    <strong style="font-size: 15px;">{{ $errors->first('kods') }}</strong>
                                @endif
                            </div>
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Uzdevuma nosaukums</label>
                                <input class="form-control" type="text"
                                       id="nosaukums"
                                       name="nosaukums"
                                       maxlength="128"
                                       value="{{old('nosaukums')}}"

                                >
                                @if ($errors->has('nosaukums'))
                                    <strong style="font-size: 15px;">{{ $errors->first('nosaukums') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Ievaddatu raksturojums</label>
                                <input class="form-control" type="text"
                                       id="ievaddati"
                                       name="ievaddati"
                                       value="{{old('ievaddati')}}"

                                >
                                @if ($errors->has('ievaddati'))
                                    <strong style="font-size: 15px;">{{ $errors->first('ievaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Izvaddatu raksturojums</label>
                                <input class="form-control" type="text"
                                       id="izvaddati"
                                       name="izvaddati"
                                       value="{{old('izvaddati')}}"

                                >
                                @if ($errors->has('izvaddati'))
                                    <strong style="font-size: 15px;">{{ $errors->first('izvaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Uzdevuma definīcija</label>
                                <textarea class="form-control" type="text"
                                          id="definicija"
                                          name="definicija"


                                >{{old('definicija')}}</textarea>
                                @if ($errors->has('definicija'))
                                    <strong style="font-size: 15px;">{{ $errors->first('definicija') }}</strong>
                                @endif
                            </div>

                            <div class="row align-content-center p-2">
                                <!-- Ievadlauks start -->
                                <div class="form-group PPS-page-title p-0 m-0">
                                    <label style="font-size: 20px;">Laika limits</label>
                                    <input class="form-control" type="number"
                                           id="time"
                                           name="time"
                                           value="{{old('time')}}"
                                    >

                                    </input>
                                    @if ($errors->has('time'))
                                        <strong style="font-size: 15px;">{{ $errors->first('time') }}</strong>
                                    @endif
                                </div><!-- Ievadlauks start -->
                                <div class="form-group PPS-page-title m-0 p-0">
                                    <label style="font-size: 20px;">Atmiņas limits</label>
                                    <input class="form-control" type="number"
                                           id="memory"
                                           name="memory"
                                           value="{{old('memory')}}"
                                    >

                                    </input>
                                    @if ($errors->has('memory'))
                                        <strong style="font-size: 15px;">{{ $errors->first('memory') }}</strong>
                                    @endif
                                </div>
                                <!-- Ievadlauks start -->
                                <div class="form-group PPS-page-title p-0 m-0">
                                    <label style="font-size: 20px;">Punkti</label>
                                    <input class="form-control" type="number"
                                           id="score"
                                           name="score" step="1" min="0"
                                           value="{{old('score')}}"
                                    >
                                    </input>
                                    @if ($errors->has('score'))
                                        <strong style="font-size: 15px;">{{ $errors->first('score') }}</strong>
                                    @endif
                                </div>
                                <!-- Ievadlauks start -->
                                <div class="form-group PPS-page-title p-0 m-0">
                                    <label style="font-size: 20px;">Grūtība</label>
                                    <input class="form-control" type="number"
                                           id="score"
                                           name="difficulty" step="1" min="0"
                                           value="{{old('difficulty')}}"
                                    >
                                    </input>
                                    @if ($errors->has('difficulty'))
                                        <strong style="font-size: 15px;">{{ $errors->first('difficulty') }}</strong>
                                    @endif
                                </div>

                            </div>
                            <div class="w-100 text-center">
                                Tagi
                                <select id="tags" name="tags[]" multiple class="PPS-info-button w-100 text-center" style="font-size: 20px;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select></div>

                            <!---
                            <label for="exampleInputFile">Pievienot attēlus WIP</label>
                            <input type="file" id="exampleInputFile">--->


                        </div>

                        <add-test id="at"></add-test>
                        @if ($errors->has('tests'))
                            <strong>{{ $errors->first('tests') }}</strong>
                        @endif



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





