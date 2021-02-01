@extends('layouts.app')

@section('content')
    <div class="row justify-content-end">
        <h4 class = 'col-sm-2'>{!! link_to_route('grades.index', '試合一覧へ戻る', [$user->id], ['class' => 'mylink']) !!}</h4>    
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-6  col-md-auto">
            <h4 class = "mb-4">成績入力</h4>
            <h5 class = "mb-4">～野手成績～</h5>
            @if(Auth::user()->is_games($game->id))
                {!! Form::open(["route" => ["grades.update" , $game->id], "method" => "put"]) !!}
            @else
                {!! Form::open(["route" => ["grades.store" , $game->id]]) !!}
            @endif
                    <div class="form-group">
                        {!! Form::label('at_bat', '打数') !!}
                        {!! Form::text('at_bat', $user->getmydata($game->id , 'at_bat'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hits', '安打数') !!}
                        {!! Form::text('hits', $user->getmydata($game->id , 'hits'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hr', 'HR数') !!}
                        {!! Form::text('hr', $user->getmydata($game->id , 'hr'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('rbi', '打点') !!}
                        {!! Form::text('rbi', $user->getmydata($game->id , 'rbi'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('steal', '盗塁') !!}
                        {!! Form::text('steal', $user->getmydata($game->id , 'steal'), ['class' => 'form-control']) !!}
                    </div>
        
                    <h5 class = "mb-4 mt-4">～投手成績～(投手のみ入力)</h5>
                    <div class="form-group">
                        {!! Form::label('winlose', '勝敗') !!}
                        {!! Form::select('winlose', ['勝'=>'勝',  '敗'=>'敗'],$user->getmydata($game->id ,'winlose') , ['placeholder' => '-','class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('innings', '投球回') !!}
                        {!! Form::text('innings', $user->getmydata($game->id ,'innings'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('conceded', '失点') !!}
                        {!! Form::text('conceded', $user->getmydata($game->id , 'conceded'), ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('strikeout', '奪三振') !!}
                        {!! Form::text('strikeout', $user->getmydata($game->id , 'strikeout'), ['class' => 'form-control']) !!}
                    </div>
                    @if(Auth::user()->is_games($game->id))
                        {!! Form::submit('変更！', ['class' => 'btn mybtn ']) !!}
                    @else
                        {!! Form::submit('入力！', ['class' => 'btn mybtn ']) !!}
                    @endif
                {!! Form::close() !!}
        </div>
    </div>
@endsection