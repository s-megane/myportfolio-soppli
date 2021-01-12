@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="row">
    <h2>イベントの作成</h2>
        <div class="col-sx-6 col-md-12 mt-3">
            {!! Form::model($event , ['route' => ['events.update', $event->id], 'method' => 'put']) !!}
            
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            <h4>{!! Form::label("eventdate" , "日付　　　　:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            <h4>{{Form::input('date','eventdate',$event->eventdate,[])}}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            <h4>{!! Form::label("title" , "イベント名　:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            <h4>{!! Form::text("title", null, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            <h4>{!! Form::label("place" , "場所　　　　:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            <h4>{!! Form::text("place", $event->place, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            <h4>{!! Form::label("meetingtime" , "集合時間　　:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            <h4>{{Form::input('time','meetingtime',$event->meetingtime,[])}}</h4>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            <h4>{!! Form::label("deadlinedate" , "回答締切日付:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            <h4>{{Form::input('date','deadlinedate',$event->deadlinedate,[])}}</h4>
                        </div>
                    </div>
                </div>
        </div>
        <div class = "col-sx-12 col-md-12">
            {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}    
        </div>
    </div>
    
</div>

@endsection