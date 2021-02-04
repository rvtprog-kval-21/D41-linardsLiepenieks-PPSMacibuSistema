@extends('adminlte::page')
@section('title', 'Izveidot uzdevumu')

@section('content_header')
    <h1>Izveidot jaunu Uzdevumu</h1>
@stop
@section('content')

    <div class="box box-primary" id="app">
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
                            <div class="form-group">
                                <label>Uzdevuma kods</label>
                                <input class="form-control" type="text"
                                       id="kods"
                                       name="kods"
                                       value="{{old('kods')??$exercise->kods}}"
                                >
                                @if ($errors->has('kods'))
                                    <strong>{{ $errors->first('kods') }}</strong>
                                @endif
                            </div>
                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Uzdevuma nosaukums</label>
                                <input class="form-control" type="text"
                                       id="nosaukums"
                                       name="nosaukums"
                                       value="{{old('nosaukums')??$exercise->nosaukums}}"
                                >
                                @if ($errors->has('nosaukums'))
                                    <strong>{{ $errors->first('nosaukums') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Ievaddatu raksturojums</label>
                                <input class="form-control" type="text"
                                       id="ievaddati"
                                       name="ievaddati"
                                       value="{{old('ievaddati')??$exercise->ievaddati}}"
                                >
                                @if ($errors->has('ievaddati'))
                                    <strong>{{ $errors->first('ievaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Izvaddatu raksturojums</label>
                                <input class="form-control" type="text"
                                       id="izvaddati"
                                       name="izvaddati"
                                       value="{{old('izvaddati')??$exercise->izvaddati}}"

                                >
                                @if ($errors->has('izvaddati'))
                                    <strong>{{ $errors->first('izvaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Uzdevuma definīcija</label>
                                <textarea class="form-control" type="text"
                                          iind="definicija"
                                          name="definicija"
                                          value="{{old('definicija')??$exercise->definicija}}"

                                >{{old('definicija')??$exercise->definicija}}</textarea>
                                @if ($errors->has('definicija'))
                                    <strong>{{ $errors->first('definicija') }}</strong>
                                @endif
                            </div>

                            <div class="row">
                                <!-- Ievadlauks start -->
                                <div class="form-group">
                                    <label>Laika limits</label>
                                    <input class="form-control" type="number"
                                           id="time"
                                           name="time"
                                           value="{{old('time')??$exercise->time}}"

                                    >

                                    </input>
                                    @if ($errors->has('time'))
                                        <strong>{{ $errors->first('time') }}</strong>
                                    @endif
                                </div><!-- Ievadlauks start -->
                                <div class="form-group">
                                    <label>Atmiņas limits</label>
                                    <input class="form-control" type="number"
                                           id="memory"
                                           name="memory"
                                           value="{{old('memory')??$exercise->memory}}"
                                    >
                                    </input>
                                    @if ($errors->has('memory'))
                                        <strong>{{ $errors->first('memory') }}</strong>
                                    @endif
                                </div>
                                <!-- Ievadlauks start -->
                                <div class="form-group">
                                    <label>Punkti</label>
                                    <input class="form-control" type="number"
                                           id="score"
                                           name="score" step="1"
                                           value="{{old('score')??$exercise->score}}"
                                    >
                                    </input>
                                    @if ($errors->has('score'))
                                        <strong>{{ $errors->first('score') }}</strong>
                                    @endif
                                </div>
                            </div>


                            <label for="exampleInputFile">Pievienot attēlus WIP</label>
                            <input type="file" id="exampleInputFile">


                        </div>
                        <add-test :old-tests="{{$exercise->tests()->get()}}"></add-test>
                        @if ($errors->has('tests'))
                            <strong>{{ $errors->first('tests') }}</strong>
                        @endif

                        <select id="tags" name="tags[]" multiple>
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}"
                                {{$exercise->tag()->find($tag->id) ? 'selected' : null}}>{{$tag->name}}</option>
                            @endforeach
                        </select>

                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <div class="box-footer">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop





