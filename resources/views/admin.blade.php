@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <h3>管理者としてログインしています</h3>
        {!! link_to_route('events.create', '新規イベントの作成', [], ['class' => 'btn btn-primary']) !!}
        <div class = "row justify-content-between">
        
        @include("events.index")
        
    @else    
        <div class="center jumbotron">
            <div class="text-center">
                <div class="text-info">
                    <h1>Welcome to the Soppli</h1>
                    <h2 >ソフトボールチームの管理アプリケーションです。</h2> 
                    <h4>ここでは、チーム内の試合日などの各イベントの情報共有、出欠連絡が行えます。</h4>
                    <p>今後いろいろな機能を実装していく予定です！！乞うご期待！！</p>
                    <p class ="mb-1">↓新規メンバー登録↓</p>
                    {!! link_to_route("signup.get" , "メンバー登録！" , [] , ['class' => 'btn btn-lg btn-info']) !!}
                    <p class = "mb-1">↓メンバーログイン↓</p>
                    {!! link_to_route("login" , "ログインする！" , [] , ['class' => 'btn btn-lg btn-info']) !!}
                </div>
            </div>    
        </div>
    @endif
@endsection
