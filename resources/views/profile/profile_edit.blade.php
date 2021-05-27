@extends('adminlte::page')
@section('title', 'Labot profilu')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

        <div>Labot profilu</div>
    </div>
@stop
@section('content')

    <div class="box box-primary p-3" id="app">
        <div class="box-header with-border">
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/profile/{{$user->id}}/edit" enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')

                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body">
                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Lietotājvārds</label>
                                <input class="form-control" type="text"
                                       id="username"
                                       name="username"
                                       value="{{old('username')??$user->profile()->first()->username}}"
                                >
                                @if ($errors->has('username'))
                                    <strong style="font-size: 15px;">{{ $errors->first('username') }}</strong>
                                @endif
                            </div>

                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Vārds</label>
                                <input class="form-control" type="text"
                                       id="name"
                                       name="name"
                                       value="{{old('name')??$user->name}}"
                                >
                                @if ($errors->has('name'))
                                    <strong style="font-size: 15px;">{{ $errors->first('name') }}</strong>
                                @endif
                            </div>

                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Epasts</label>
                                <input class="form-control" type="email"
                                       id="email"
                                       name="email"
                                       value="{{old('email')??$user->email}}"
                                >
                                @if ($errors->has('email'))
                                    <strong style="font-size: 15px;">{{ $errors->first('email') }}</strong>
                                @endif
                            </div>

                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Mainīt paroli</label>
                                <input class="form-control" type="password"
                                       id="password"
                                       name="password"
                                       value="{{old('password')??null}}"
                                >
                                @if ($errors->any())
                                    <strong style="font-size: 15px;">{{ $errors->first('password') }}</strong>
                                @endif
                            </div>

                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px;">Atkārtot paroli</label>
                                <input class="form-control" type="password"
                                       id="rpassword"
                                       name="rpassword"
                                >
                                @if ($errors->has('rpassword'))
                                    <strong style="font-size: 15px;">{{ $errors->first('v') }}</strong>
                                @endif
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





