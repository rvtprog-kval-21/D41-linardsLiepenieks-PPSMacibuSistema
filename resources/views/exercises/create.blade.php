@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Izveidot jaunu Uzdevumu</h1>
@stop
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/exercises" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body">
                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Uzdevuma kods</label>
                                <input class="form-control" type="text"
                                        id="kods"
                                       name="kods"
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
                                >
                                @if ($errors->has('izvaddati'))
                                    <strong>{{ $errors->first('izvaddati') }}</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Uzdevuma definīcija</label>
                                <textarea class="form-control" type="text"
                                        id="definicija"
                                       name="definicija"
                                ></textarea>
                                @if ($errors->has('definicija'))
                                    <strong>{{ $errors->first('definicija') }}</strong>
                                @endif
                            </div>







                            <div class="form-group">
                                <label for="exampleInputFile">Pievienot attēlus WIP</label>
                                <input type="file" id="exampleInputFile">

                            </div>

                        </div>

                        <div class="box">
                            <div class="box-header with-border row align-items-center justify-content-between">
                                <div class="col-9"><h3 class="box-title">Pievienot paraugdatus WIP</h3>
                                </div>
                                <button type="button" class="btn btn-default bg-green"><i
                                        class="far fa-plus-square"></i></button>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Stdin</th>
                                            <th>Stdout</th>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@stop


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
