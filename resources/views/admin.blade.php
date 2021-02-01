@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class = "row justify-content-center">
            <div class = "col-lg-12  col-sm-6 col-md-12 text-center">
                <h4>※管理者としてログインしています</h4>
                <div class = 'mb-3'>
                    {!! link_to_route('events.create', '新規イベントの作成', [], ['class' => 'btn mybtn']) !!}
                </div>
                @include("games.index")
            </div>
            <div class = "mb-5"></div>
        </div>
        <div class = "row justify-content-center">  
            @include("events.index")
        </div>
    @endif
@endsection
