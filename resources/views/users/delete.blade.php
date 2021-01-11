@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sx-4">
            <h3>{{$user->name}}さん、チームを退部しますがよろしいでしょうか？</h3>
            @if ($user->role === 1)
                <a href="/admin">{!! Form::submit('思いとどまる！！', ['class' => 'btn btn-primary']) !!}</a>
            @else
                <a href="/">{!! Form::submit('思いとどまる！！', ['class' => 'btn btn-primary']) !!}</a>
            @endif
            {!! Form::open(['route' => ['users.destroy', $user->id] ,'method' => 'delete']) !!}
                {!! Form::submit('退部します', ['class' => "btn btn-danger"]) !!}
            {!! Form::close() !!}
        </aside>
    </div>
@endsection