@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class = "col-sm-10 col-md-12">
        <div class = "text-center">
            <h2>{{$game->opponent}}戦試合詳細</h2>
            @if($status == 1)
            {!! link_to_route('grades.edit', \Auth::user()->name.'の成績入力' , [$game->id],['class' => 'mylink']) !!}
            @endif
            <table class="table table-border  table-striped">
                <thead>
                    <tr>
                        <th>名前</th>
                        <th>打席数</th>
                        <th>安打数</th>
                        <th>打率</th>
                        <th>HR数</th>
                        <th>打点</th>
                        <th>盗塁</th>
                        <th>投球回</th>
                        <th>失点数</th>
                        <th>防御率</th>
                        <th>奪三振</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($game->usergames()->get() as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->pivot->at_bat}}</td>
                        <td>{{$user->pivot->hits}}</td>
                        <td>{{$user->getaverage($game->id)}}</td>
                        <td>{{$user->pivot->hr}}</td>
                        <td>{{$user->pivot->rbi}}</td>
                        <td>{{$user->pivot->steal}}</td>
                        <td>{{$user->pivot->innings}}</td>
                        <td>{{$user->pivot->conceded}}</td>
                        <td>{{$user->geteraverage($game->id)}}</td>
                        <td>{{$user->pivot->strikeout}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if(Auth::user()->role <= 2)
                <a class = 'mylink' href="/admin" >戻る</a>
            @else
                <a class = 'mylink' href="/">戻る</a>
            @endif
        </div>    
    </div>
</div>
@endsection