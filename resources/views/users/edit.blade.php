@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="row">
    <h2>{{$user->name}}のプロフィール編集</h2>
        <div class="col-sx-6 col-md-10">
            @csrf
            {!! Form::model($user , ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
            
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            {!! Form::label("name" , "登録名:") !!}
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::text("name", null, ["class" => "form-control"]) !!}
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">    
                            {!! Form::label("email" , "メアド:") !!}
                        </div>
                        <div class = "col-sx-6 col-md-4">
                            {!! Form::email("email", null, ["class" => "form-control"]) !!}
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label("birthday" , "生年月日:") !!}
                    <p>例　2020　1　10</p>
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("birthday" , "年:") !!}
                        </div>
                        <div class = "col-sx-6 col-md-2">
                            {!! Form::text('year', $myyear, ['placeholder' => '年','class' => 'form-control']) !!}
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("birthday" , "月:") !!} 
                        </div>
                        <div class = "col-sx-6 col-md-1">    
                            {!! Form::text('month', $mymonth, ['placeholder' =>'月' , 'class' => 'form-control']) !!}
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("birthday" , "日:") !!}  
                        </div>
                        <div class = "col-sx-6 col-md-1">
                            {!! Form::text('day',  $myday, ['placeholder' => '日', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("mynum" , "背番号:") !!}
                        </div>    
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::text("mynum", null, ["class" => "form-control"]) !!}
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    {!! Form::label("dominant" , "投/打:") !!}
                    <div class = "row">
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("dominant_def" , "利き手:") !!}
                        </div>    
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::select("dominant_def", ['右'=>'右', '左' => '左'], null,['class' => 'form-control']) !!}
                        </div>
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::label("dominant_bat" , "打席:") !!}
                        </div>    
                        <div class = "col-sx-6 col-md-auto">
                            {!! Form::select("dominant_bat", ['右'=>'右', '左' => '左', '両' => '両'], null ,['class' => 'form-control']) !!}
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