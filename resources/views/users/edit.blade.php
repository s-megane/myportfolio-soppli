@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
    <h2>{{$user->name}}のプロフィール編集</h2>
    
        <div class="col-sx-6 col-md-10">
            <div class = 'mb-3'></div>
            @csrf
            {!! Form::model($user , ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
            
            <div class="form-group">
                <div class = "row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        {!! Form::label("Name" , "登録名:") !!}
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::text("Name", $user->name, ["class" => "form-control"]) !!}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class = "row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">    
                        {!! Form::label("Email" , "メアド:") !!}
                    </div>
                    <div class = "col-sx-6 col-md-4">
                        {!! Form::email("Email", $user->email, ["class" => "form-control"]) !!}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class = "row justify-content-center">
                    
                {!! Form::label("birthday" , "生年月日:") !!}
                <p>例　2020　1　10</p>
                </div>
                <div class = "row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::label("birthday" , "年:") !!}
                    </div>
                    <div class = "col-sx-6 col-md-2">
                        {!! Form::text('year', $myyear, ['placeholder' => '年','class' => 'form-control']) !!}
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::label("birthday" , "月:") !!} 
                    </div>
                    <div class = "col-sx-6 col-md-2">    
                        {!! Form::text('month', $mymonth, ['placeholder' =>'月' , 'class' => 'form-control']) !!}
                    </div>
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::label("birthday" , "日:") !!}  
                    </div>
                    <div class = "col-sx-6 col-md-2">
                        {!! Form::text('day',  $myday, ['placeholder' => '日', 'class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class = "row justify-content-center">
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::label("mynum" , "背番号:") !!}
                    </div>    
                    <div class = "col-sx-6 col-md-auto">
                        {!! Form::text("mynum", null, ["class" => "form-control"]) !!}
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class = "text-center">投/打</div>
                <div class = 'mb-2'></div>
                <div class = "row justify-content-center">
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
            <div class = 'text-center'>
                <div class = "col-sx-12 col-md-12">
                    {!! Form::submit('更新', ['class' => 'btn mybtn']) !!}
                {!! Form::close() !!}    
                </div>
            </div>
        </div>
    </div>
@endsection