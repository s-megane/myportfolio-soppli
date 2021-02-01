@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class = "col-sx-6 col-md-auto">
            <h2>イベントの作成</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class = "col-sx-6 col-md-auto">
            @if (\Auth::user()->role <= 2)
                <a class = 'mylink' href="/admin" >戻る</a>
            @else
                <a class = 'mylink' href="/" >戻る</a>
            @endif
        </div>
    </div>
    <div class = 'mt-2 mb-3'></div>
        {!! Form::model($event , ['route' => ['events.update', $event->id], 'method' => 'put']) !!}
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        <h4>{!! Form::label("eventdate" , "日付　　　　:") !!}</h4>
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        <h4>{{Form::input('date','eventdate',$event->eventdate,[])}}</h4>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        <h4>{!! Form::label("title" , "イベント名　:") !!}</h4>
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        <h4>{!! Form::text("title", $event->title, ["class" => "form-control"]) !!}</h4>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        <h4>{!! Form::label("place" , "場所　　　　:") !!}</h4>
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        <h4>{!! Form::text("place", "喜久田スポーツ広場", ["class" => "form-control"]) !!}</h4>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        <h4>{!! Form::label("meetingtime" , "集合時間　　:") !!}</h4>
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        <h4>{{Form::input('time','meetingtime',"07:00:00",[])}}</h4>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        <h4>{!! Form::label("deadlinedate" , "回答締切日付:") !!}</h4>
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        <h4>{{Form::input('date','deadlinedate',$event->deadlinedate,[])}}</h4>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::submit('更新', ['class' => 'btn mybtn']) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!} 
@endsection