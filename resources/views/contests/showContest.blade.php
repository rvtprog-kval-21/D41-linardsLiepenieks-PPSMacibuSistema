@extends('adminlte::page')

@section('title', 'Admin panel')

@section('content_header')
    <div class=" justify-content-between PPS-page-title">
        <div class="mb-3 p-0">{{$contest->name}}</div>
    </div>
@stop


@section('content')
    <div id="app">
        @if($contest->user_id != null)
            @if($contest->user_id == \Illuminate\Support\Facades\Auth::user()->id && \Illuminate\Support\Facades\Auth::user()->teacher == 1)
                <div class="row">
                    <button type="button" class=" col-2 btn-block btn PPS-add-button btn-xs m-0"
                            onclick="location.href='/contests/{{$contest->id}}/users'">
                        Pievienot dalībniekus
                    </button>
                    <button type="button" class=" col-2 btn-block btn PPS-info-button btn-xs m-0"
                            onclick="location.href='/contests/{{$contest->id}}/users/exercises'">
                        Apskatīt dalībnieku izpildītos uzdevumus
                    </button>
                </div>
            @endif
        @endif
        <div class="PPS-content-wrapper d-flex justify-content-center" style="color: black;">
            <div class="col-8 p-4">
                {!! $contest->desc !!}
            </div>
        </div>
            <div class="mt-5">


                                    <exercise-search
                                        :exercises="{{$contest->exercise()->orderBy('difficulty', 'asc')->get()}}"
                                        :solutions="{{\App\Models\Solution::All()}}"
                                        :submissions="{{\App\Models\Submission::All()}}"
                                        :exercise_tags="{{DB::table('exercise_tag')->get()}}"
                                        :tags="{{\App\Models\Tag::All()}}"
                                        :contest="{{true}}"></exercise-search>




        </div>


    </div>

@stop



