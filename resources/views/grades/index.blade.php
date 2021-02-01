@extends('layouts.app')

@section('content')

<div class = "text-center">
    <div class="row justify-content-center">
        <div class="col-sm-Auto col-mb-10">
            
            @if($events->count() == 0)
                <h4>{{\Auth::user()->name}}さんが{{$now}}年に参加した大会はありません。</h4>
            @else
                <h4>{{\Auth::user()->name}}さんが{{$now}}年に参加した大会一覧です。</h4>
                <h4>その中から出場した試合を選択して成績入力してください。</h4>
                <h4>
                    <div class = 'mb-4'></div>
                    <table class="table table-border">
                        <thead>
                            <tr>
                                <th>日付</th>
                                <th>大会名</th>
                                <th>試合</th>
                                <th>対戦チーム</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                @foreach($event->games()->get() as $game)
                                    <tr>
                                        <td>{{$event->eventdate}}</td>
                                        <td>{{$event->title}}</td>
                                        <td>{!! link_to_route('grades.edit', $game->title , [$game->id],['class' => 'mylink']) !!}</td>
                                        <td>{{$game->opponent}}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </h4>
            @endif
        </div>        
    </div>
    {!! link_to_route('users.show', "戻る" , ["user" => Auth::id()],['class' => 'mylink']) !!}
</div>
@endsection