@extends('layouts.app')

@section('content')

<div class="row">
        <div class="col-6">
            {!! Form::model($Aduser, ['route' => ['adminuser.update', $Aduser->id], 'method' => 'put']) !!}
                <h4>{{$Aduser->name}}の権限を変更します。</h4>
                <p>1 → 管理者に変更 　　3 → 一般ユーザーに変更</p> 
                <div class="form-group">
                    {!! Form::label('role', 'role:') !!}
                    {!! Form::text('role', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('変更', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>

@endsection
