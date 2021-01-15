@extends('layouts.app')

@section('content')

    <div class="row justify-content-around">
        <div class = "text-center">
            <div class = "col-xs-12 col-md-Auto">
                <h1>イベント詳細</h1>
                @if (\Auth::user()->role ===1)
                    {!! Form::open(['route' => ['mail.send', $event->id]]) !!}
                        {!! Form::submit('出欠確認メール送信', ['class' => "btn btn-primary"]) !!}
                    {!! Form::close() !!}
                @endif 
                <div class = "mt-1">
                    <table class="table table-borderless">
                        <tr>
                            <th><h3>開催日</h3></th>
                            <td><h3>{{ $event->eventdate }}</h3></td>
                        </tr>            
                        <tr>
                            <th><h3>イベント名</h3></th>
                            <td><h3>{{ $event->title }}</h3></td>
                        </tr> 
                        <tr>
                            <th><h3>場所</h3></th>
                            <td><h3>{{ $event->place }}</h3></td>
                        </tr>
                        <tr>    
                            <th><h3>集合時間</h3></th>
                            <td><h3>{{ substr($event->meetingtime, 0, 5) }}</h3></td>
                        </tr>
                        <tr>    
                            <th><h3>回答締め切り日</h3></th>
                            <td><h3 class="text-danger">{{ $event->deadlinedate }}</h3></td>
                        </tr>
                    </table>
                    <div class = "m-4">
                        <div class = "row justify-content-center">
                            <div class = "col-xs-6 col-mb-Auto">
                                <div class = "mr-2">
                                @if (\Auth::user()->role ===1)
                                    {!! link_to_route('events.edit', '内容変更する', [$event->id], ['class' => 'btn btn-secondary']) !!}
                                @endif  
                                </div>
                            </div>
                            <div class = "col-xs-6 col-mb-Auto">
                                <div class = "ml-2">
                                @if (\Auth::user()->role ===1)
                                    {!! Form::open(['route' => ['events.destroy', $event->id] ,'method' => 'delete']) !!}
                                        {!! Form::submit('イベント削除', ['class' => "btn btn-danger"]) !!}
                                    {!! Form::close() !!}
                                @endif 
                                </div>
                            </div>   
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class = "row justify-content-center">
                <div class = "col-xs-6 col-md-Auto">
                    @if (Auth::user()->is_attendance($event->id))
                        {!! Form::open(['route' => ['attendance.update', $event->id] ,'method' => 'put']) !!}
                            {!! Form::hidden('status' , 1) !!}
                            {!! Form::submit('参加', ['class' => "btn btn-primary"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['attendance.store', $event->id]]) !!}
                            {!! Form::hidden('status' , 1) !!}
                            {!! Form::submit('参加', ['class' => "btn btn-primary"]) !!}
                        {!! Form::close() !!}
                    @endif
                    <span>参加人数{{ $event->attendances()->wherepivot("status", 1)->count() }}人</span>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>参加者一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->attendances()->wherepivot("status", 1)->get() as $user)
                                <tr>
                                    @if ($user->role == 1)
                                        <td>☆{{$user->name}}</td>
                                    @else
                                        <td>{{$user->name}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
                <div class = "col-xs-6 col-md-Auto">    
                    @if (Auth::user()->is_attendance($event->id))
                        {!! Form::open(['route' => ['attendance.update', $event->id] ,'method' => 'put']) !!}
                            {!! Form::hidden('status' , 2) !!}
                            {!! Form::submit('不参加', ['class' => "btn btn-success"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['attendance.store', $event->id]]) !!}
                            {!! Form::hidden('status' , 2) !!}
                            {!! Form::submit('不参加', ['class' => "btn btn-success"]) !!}
                        {!! Form::close() !!}
                    @endif
                    <span>不参加人数{{ $event->attendances()->wherepivot("status", 2)->count() }}人</span>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>不参加一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->attendances()->wherepivot("status", 2)->get() as $user)
                                <tr>
                                    @if ($user->role == 1)
                                        <td>☆{{$user->name}}</td>
                                    @else
                                        <td>{{$user->name}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class = "col-xs-6 col-md-Auto"> 
                     @if (Auth::user()->is_attendance($event->id))
                        {!! Form::open(['route' => ['attendance.update', $event->id] ,'method' => 'put']) !!}
                            {!! Form::hidden('status' , 3) !!}
                            {!! Form::submit('保留', ['class' => "btn btn-info"]) !!}
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['route' => ['attendance.store', $event->id]]) !!}
                            {!! Form::hidden('status' , 3) !!}
                            {!! Form::submit('保留', ['class' => "btn btn-info"]) !!}
                        {!! Form::close() !!}
                    @endif
                    <span>保留人数{{ $event->attendances()->wherepivot("status", 3)->count() }}人</span>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>保留一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($event->attendances()->wherepivot("status", 3)->get() as $user)
                                <tr>
                                    @if ($user->role == 1)
                                        <td>☆{{$user->name}}</td>
                                    @else
                                        <td>{{$user->name}}</td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class = "row justify-content-end">
            <div class = "col-xs-6 col-md-Auto">
                <span>未回答者{{ $users->count() }}人</span>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>未回答者</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                @if ($user->role == 1)
                                    <td>☆{{$user->name}}</td>
                                @else
                                    <td>{{$user->name}}</td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection