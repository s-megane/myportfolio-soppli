@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="row">
    <h2>{{$user->name}}のプロフィール編集</h2>
        <div class="col-sx-6 col-md-10">
            @csrf
            {!! Form::model($user , ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
            
                <div class="form-group">
                    {!! Form::label("name" , "登録名の変更:") !!}
                    {!! Form::text("name", null, ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("birthday" , "生年月日:") !!}
                    <div class = "mb-2">
                    {!! Form::selectRange('yaer', '1963', '2020', $year, ['placeholder' => '年','class' => 'form-control']) !!}
                    </div>
                    <div class = "mb-2">
                    {!! Form::selectRange('month', '01', '12', $month, ['placeholder' =>'月' , 'class' => 'form-control']) !!}
                    </div>
                    <div class = "mb-2">
                    {!! Form::selectRange('day', '1', '31', $day, ['placeholder' => '日', 'class' => 'form-control']) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label("mynum" , "背番号:") !!}
                    {!! Form::text("mynum", null, ["class" => "form-control"]) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label("dominant" , "投/打:") !!}
                    <div class = "row">
                        <div class = "col-sx-6 col-md-1">
                            {!! Form::label("dominant_def" , "投:") !!}
                        </div>    
                        <div class = "col-sx-6 col-md-5">
                            {!! Form::select("dominant_def", ['右'=>'右', '左' => '左'], null,['placeholder' => '利き手', 'class' => 'form-control']) !!}
                        </div>
                        <div class = "col-sx-6 col-md-1">
                            {!! Form::label("dominant_bat" , "打:") !!}
                        </div>    
                        <div class = "col-sx-6 col-md-5">
                            {!! Form::select("dominant_bat", ['右'=>'右', '左' => '左', '両' => '両'], null ,['placeholder' => '打席', 'class' => 'form-control']) !!}
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