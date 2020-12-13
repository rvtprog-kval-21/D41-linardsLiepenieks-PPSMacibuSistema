@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <h1>Izveidot jaunu ierakstu</h1>

@stop
@section('content')

    <div class="box box-primary">
        <div class="box-header with-border">
            <!-- /.box-header -->
            <!-- form start -->
            <form action="/news" enctype="multipart/form-data" method="post">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-6">
                        <div class="box-body">

                            <!-- Ievadlauks start -->
                            <div class="form-group">
                                <label>Ieraksta nosaukums</label>
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
                                <label>Ieraksta apraksts</label>
                                <textarea class="form-control" type="text"
                                          id="apraksts"
                                          name="apraksts"
                                ></textarea>
                                @if ($errors->has('apraksts'))
                                    <strong>{{ $errors->first('apraksts') }}</strong>
                                @endif
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
