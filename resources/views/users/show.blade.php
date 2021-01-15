@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h1 class="border border-primary">{{ $user->name }}のプロフィール</h1>
        @if(Auth::id() === $user->id)
            <span>{!! link_to_route('users.edit', 'プロフィール編集', [ $user->id], ['class' => 'btn btn-light']) !!}</span>
        @endif
            <table class="table table-border">
                <div class = "text-center">
                <tbody　class = "col-sx-4">
                    <tr>
                        <th><h4>年齢</h4></th>
                        <td><h4>{{$user->user_age()}}歳</h4></td>
                    </tr>
                    <tr>
                        <th><h4>背番号</th>
                        <td><h4>{{ $user->mynum }}</h4></td>
                    </tr>
                    
                    <tr>
                        <th><h4>投/打</h4></th>
                        <td><h4>{{ $user->dominant_def }}/{{ $user->dominant_bat }}</h4></td>
                    </tr>
                     
                </tbody>
                </div>
            </table>
           
    </div>
    <div class = "m-4">
        <div class = "row justify-content-center">
            <div class = "col-xs-6 col-mb-Auto">
                <div class = "mr-2">
                    @if (\Auth::user()->role ===1)
                        {!! link_to_route('adminuser.edit', '権限を変更する', [$user->id], ['class' => 'btn btn-light']) !!}
                    @endif
                </div>
            </div>
            <div class = "col-xs-6 col-mb-Auto">
                <div class = "ml-2">
                    @if (\Auth::user()->role ===1)
                        {!! Form::open(['route' => ['adminuser.destroy', $user->id] ,'method' => 'delete']) !!}
                            {!! Form::submit('このメンバーを削除する', ['class' => "btn btn-danger"]) !!}
                        {!! Form::close() !!}
                    @endif 
                </div>
            </div> 
        </div>
    </div>    
@endsection