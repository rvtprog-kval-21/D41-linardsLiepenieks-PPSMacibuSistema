@extends('adminlte::page')
@section('title', 'Nosūtīt uzdevumu')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">

        <div>Nosūtīt uzdevumu {{$exercise->kods}}</div>
        <div>
            @stop
            @section('content')
                <div id="app" class="row justify-content-center w-100" >
                    <form action="/exercises/{{$exercise->id}}/send" enctype="multipart/form-data" method="post" class=" row w-100 justify-content-center mt-3">
                        @csrf
                        <div class="w-75" >
                            <div style="width: 100%;">
                                <codemirror></codemirror>
                            </div>
                            <button type="submit" class="btn PPS-info-button mt-2" style="margin: 0; width: 100px;">Sūtīt</button>
                        </div>
                    </form>
                </div>



@stop





