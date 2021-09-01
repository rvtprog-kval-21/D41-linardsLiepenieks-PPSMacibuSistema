@extends('adminlte::page')
@section('title', 'Izveidot uzdevumu')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

        <div>Labot uzdevumu {{$exercise->nosaukums}}</div>
    </div>
@stop
@section('content')

    <div class="box box-primary p-3" id="app">
        <div class="box-header with-border">
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/exercises/{{$exercise->id}}" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body">
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Uzdevuma kods</label>
                                <input class="form-control" type="text"
                                       id="kods"
                                       name="kods"
                                       value="{{old('kods')??$exercise->kods}}"
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
                                       value="{{old('nosaukums')??$exercise->nosaukums}}"
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
                                       value="{{old('ievaddati')??$exercise->ievaddati}}"
                                >
                                @if ($errors->has('ievaddati'))
                                    <strong style="font-size: 15px;"> {{ $errors->first('ievaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Izvaddatu raksturojums</label>
                                <input class="form-control" type="text"
                                       id="izvaddati"
                                       name="izvaddati"
                                       value="{{old('izvaddati')??$exercise->izvaddati}}"

                                >
                                @if ($errors->has('izvaddati'))
                                    <strong style="font-size: 15px;">{{ $errors->first('izvaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Uzdevuma definīcija</label>
                                <textarea class="form-control" type="text"
                                          iind="definicija"
                                          name="definicija"
                                          value="{{old('definicija')??$exercise->definicija}}"

                                >{{old('definicija')??$exercise->definicija}}</textarea>
                                @if ($errors->has('definicija'))
                                    <strong style="font-size: 15px;">{{ $errors->first('definicija') }}</strong>
                                @endif
                            </div>

                            <div class="row">
                                <!-- Ievadlauks start -->
                                <div class="form-group ">
                                    <label style="font-size: 20px;">Laika limits</label>
                                    <input class="form-control" type="number"
                                           id="time"
                                           name="time"
                                           value="{{old('time')??$exercise->time}}"

                                    >

                                    </input>
                                    @if ($errors->has('time'))
                                        <strong style="font-size: 15px;">{{ $errors->first('time') }}</strong>
                                    @endif
                                </div><!-- Ievadlauks start -->
                                <div class="form-group ">
                                    <label style="font-size: 20px;">Atmiņas limits</label>
                                    <input class="form-control" type="number"
                                           id="memory"
                                           name="memory"
                                           value="{{old('memory')??$exercise->memory}}"
                                    >
                                    </input>
                                    @if ($errors->has('memory'))
                                        <strong style="font-size: 15px;">{{ $errors->first('memory') }}</strong>
                                    @endif
                                </div>
                                <!-- Ievadlauks start -->
                                <div class="form-group">
                                    <label style="font-size: 20px;">Punkti</label>
                                    <input class="form-control" type="number"
                                           id="score"
                                           name="score" step="1" min="0"
                                           value="{{old('score')??$exercise->score}}"
                                    >
                                    </input>
                                    @if ($errors->has('score'))
                                        <strong style="font-size: 15px;">{{ $errors->first('score') }}</strong>
                                    @endif
                                </div>

                                <div class="form-group  p-0 m-0">
                                    <label style="font-size: 20px;">Grūtība</label>
                                    <input class="form-control" type="number"
                                           id="difficulty"
                                           name="difficulty" step="1" min="0"
                                           value="{{old('difficulty')??$exercise->difficulty}}"
                                    >
                                    </input>
                                    @if ($errors->has('difficulty'))
                                        <strong style="font-size: 15px;">{{ $errors->first('difficulty') }}</strong>
                                    @endif
                                </div>

                                <!-- Ievadlauks start -->
                                <div class="form-group PPS-page-title p-0 m-0">
                                    <label style="font-size: 20px;">Minimālais punktu skaits</label>
                                    <input class="form-control" type="number"
                                           id="minScore"
                                           name="minScore" step="1" min="0"
                                           value="{{old('minScore')??$exercise->minScore}}"
                                    >
                                    </input>
                                    @if ($errors->has('minScore'))
                                        <strong style="font-size: 15px;">{{ $errors->first('minScore') }}</strong>
                                    @endif
                                </div>
                            </div>
                            <div class="w-100 text-center">
                                Tagi
                                <select id="tags" name="tags[]" multiple class="PPS-info-button w-100 text-center"
                                        style="font-size: 20px;">
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select></div>


                            <!--- <label for="exampleInputFile">Pievienot attēlus WIP</label>
                             <input type="file" id="exampleInputFile"> --->


                        </div>
                        <add-test :old-tests="{{$exercise->tests()->get()}}"></add-test>
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





