@extends('adminlte::page')

@section('title', 'Profils')

@section('content_header')
    <div class="row justify-content-between PPS-page-title">
        <div>Sacensības</div>

    </div>
@stop


@section('content')

    @if(\Illuminate\Support\Facades\Auth::user()->teacher == 1)
        <button type="button" class=" col-2 btn-block btn PPS-add-button btn-xs m-0"
                onclick="location.href='/contests/create'">
            Izveidot Sacensības
        </button>
    @endif

    <div class="m-0 justify-content-center">
        @if(\Illuminate\Support\Facades\Auth::user()->teacher == 1)
            <h2 class="mb-4" style="color: black;">Manas pārvaldāmās sacensības</h2>
            <div class="d-flex justify-content-center flex-wrap">

                @foreach($createdContests as $contest)
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
                                overflow: hidden;">{{$contest->name}}</div>
                            <div class="col-3" style="text-overflow: ellipsis;
                                overflow: hidden;"><em>{{$contest->type == 'contest'? 'sacensības' : 'olimpiāde'}}</em>
                            </div>
                            <div class="col-1"><i
                                    class="{{$contest->private? 'fas fa-lock' : 'fas fa-lock-open'}}"></i>
                            </div>
                        </div>
                        <div>
                            <div class="row">
                                <button type="button" class="col-6 m-0 btn-block btn PPS-delete-button btn-xs"
                                        onclick="location.href='/contests/del/{{$contest->id}}'">
                                    Dzēst sacensības
                                </button>
                                <button type="button" class="col-6 m-0 btn-block btn PPS-edit-button btn-xs"
                                        onclick="location.href='/contests/edit/{{$contest->id}}'">
                                    Labot sacensības
                                </button>
                            </div>
                            <div class="p-3"><a style="color: black;"
                                                href="/contests/show/{{$contest->id}}">{!! $contest->desc !!}</a></div>
                            <button type="button" class="col m-0 btn-block btn PPS-info-button btn-xs position-absolute"
                                    style="bottom: 0;"
                                    onclick="location.href='/contests/show/{{$contest->id}}'">
                                Apskatīt sacensības
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div class="m-0 justify-content-center">
        @if(\Illuminate\Support\Facades\Auth::user()->contest()->count() >0)
            <h2 class="mb-4" style="color: black;">Manas sacensības</h2>
        @endif
        <div class="d-flex justify-content-center flex-wrap">

            @foreach(\Illuminate\Support\Facades\Auth::user()->contest()->get() as $contest)
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
                                overflow: hidden;">{{$contest->name}}</div>
                        <div class="col-3" style="text-overflow: ellipsis;
                                overflow: hidden;"><em>{{$contest->type == 'contest'? 'sacensības' : 'olimpiāde'}}</em>
                        </div>
                        <div class="col-1"><i
                                class="{{$contest->private? 'fas fa-lock' : 'fas fa-lock-open'}}"></i>
                        </div>
                    </div>
                    <div>
                        <div class="p-3"><a style="color: black;"
                                            href="/contests/show/{{$contest->id}}">{!! $contest->desc !!}</a></div>
                        <button type="button" class="col m-0 btn-block btn PPS-info-button btn-xs position-absolute"
                                style="bottom: 0;"
                                onclick="location.href='/contests/show/{{$contest->id}}'">
                            Apskatīt sacensības
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="m-0 justify-content-center">
        @if(\App\Models\Contest::all()->where('private','=', '0')->count() >0)
            <h2 class="mb-4" style="color: black;">Publiskās sacensības</h2>
        @endif
        <div class="d-flex justify-content-center flex-wrap">




        @foreach(\App\Models\Contest::all()->where('private','=', '0')->where('contestStart', '<', strtotime(\Carbon\Carbon::now()))->where('contestEnd', '>', strtotime(\Carbon\Carbon::now())) as $contest)

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
                                overflow: hidden;">{{$contest->name}}</div>
                        <div class="col-3" style="text-overflow: ellipsis;
                                overflow: hidden;"><em>{{$contest->type == 'contest'? 'sacensības' : 'olimpiāde'}}</em>
                        </div>
                        <div class="col-1"><i
                                class="{{$contest->private? 'fas fa-lock' : 'fas fa-lock-open'}}"></i>
                        </div>
                    </div>
                    <div>
                        <div class="p-3"><a style="color: black;"
                                            href="/contests/show/{{$contest->id}}">{!! $contest->desc !!}</a></div>
                        <button type="button" class="col m-0 btn-block btn PPS-info-button btn-xs position-absolute"
                                style="bottom: 0;"
                                onclick="location.href='/contests/show/{{$contest->id}}'">
                            Apskatīt sacensības
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



@stop



