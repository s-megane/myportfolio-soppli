@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <div class = "row justify-content-center">
            <div class = "col-sm-6 col-md-12 text-center">
                @include("games.index")
            </div>
            <div class = "mb-5"></div>
        </div>
        <div class = "d-flex justify-content-center">  
            @include("events.index")
        </div>
    @else    
        <div class="center jumbotron jumbotronbg">
            <div class="text-center">
                <div class="text">
                    <h1>Welcome to the Soppli</h1>
                    <h2 >KBWの管理アプリケーションです。</h2> 
                    <h4>ここでは、チーム内の試合日などの各イベントの情報共有、出欠連絡が行えます。</h4>
                    <p>今後いろいろな機能を実装していく予定です！！乞うご期待！！</p>
                    <p class ="mb-1">↓新規メンバー登録↓</p>
                    {!! link_to_route("signup.get" , "メンバー登録！" , [] , ['class' => 'btn mybtn']) !!}
                    
                    <p class = "mb-1">↓メンバーログイン↓</p>
                    {!! link_to_route("login" , "ログインする！" , [] , ['class' => 'btn mybtn']) !!}
                    
                </div>
            </div>    
        </div>
    @endif
@endsection
