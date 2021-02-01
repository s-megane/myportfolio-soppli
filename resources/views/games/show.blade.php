@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class = "col-sm-6 col-md-12">
            <div class = "text-center"> 
                <h1>{{$event->eventdate}}日の試合日程</h1>
                @foreach($games as $game)
                    <h1>{!! link_to_route('games.edit', $game->title, [$game->id], ['class' => 'mylink games', ]) !!}</h1>
                @endforeach
                <div class = 'mt-4 mb-4'>
                    {!! link_to_route('events.show', "戻る" , [$event->id],['class' => 'mylink']) !!}
                </div>    
            </div>
        </div>
    </div>
@endsection