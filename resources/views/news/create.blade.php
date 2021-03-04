@extends('adminlte::page')
@section('title', 'Dashboard')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
    <div>Izveidot jaunu ierakstu</div>
    </div>

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
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px">Ieraksta nosaukums</label>
                                <input class="form-control" type="text"
                                       id="nosaukums"
                                       name="nosaukums"
                                       value="{{old('nosaukums')}}"
                                >
                                @if ($errors->has('nosaukums'))
                                    <strong style="font-size: 15px;">Nosaukuma lauks ir nepieciešams</strong>
                                @endif
                            </div>

                            <!-- Ievadlauks start -->
                            <div class="form-group PPS-page-title">
                                <label style="font-size: 20px">Ieraksta apraksts</label>
                                <textarea class="form-control" type="text"
                                          id="apraksts"
                                          name="apraksts"
                                >{{old('apraksts')}}</textarea>
                                @if ($errors->has('apraksts'))
                                    <strong style="font-size: 15px;">Apraksta lauks ir nepieciešams</strong>
                                @endif
                            </div>










                            <div class="box-footer">
                                <button type="submit" class="btn PPS-info-button">Saglabāt</button>
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
