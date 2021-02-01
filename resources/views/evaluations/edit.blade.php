@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <h2>{{$user->name}}さんを評価してみましょう！！</h2>
        <h3>1~8の8段階(8が最も良い)で評価お願いします。</h3>
        <h5>※参考 1→G 2→F 3→E 4→D 5→C 6→B 7→A 8→S</h5>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6  col-md-auto">
            @if(Auth::user()->is_evaluations($user->id))
                {!! Form::open(["route" => ["evaluation.update" , $user->id], "method" => "put"]) !!}
            @else
                {!! Form::open(["route" => ["evaluation.store" , $user->id]]) !!}
            @endif
                    <div class="form-group">
                        {!! Form::label('meet', 'ミート力') !!}
                        {!! Form::text('meet', $user->getAbility($user->id,"meet"), ['class' => 'form-control']) !!}
                        
                    </div>
                    <div class="form-group">
                        {!! Form::label('power', 'パワー') !!}
                        {!! Form::text('power', $user->getAbility($user->id,"power"), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('run', '走力') !!}
                        {!! Form::text('run', $user->getAbility($user->id,"run"), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('defense', '守備力') !!}
                        {!! Form::text('defense', $user->getAbility($user->id,"defense"), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('shoulder', '肩の強さ') !!}
                        {!! Form::text('shoulder', $user->getAbility($user->id,"shoulder"), ['class' => 'form-control']) !!}
                    </div>
                    @if(Auth::user()->is_evaluations($user->id))
                        {!! Form::submit('変更！', ['class' => 'btn mybtn']) !!}
                    @else
                        {!! Form::submit('評価！', ['class' => 'btn mybtn']) !!}
                    @endif
                {!! Form::close() !!}
        </div>
    </div>
@endsection