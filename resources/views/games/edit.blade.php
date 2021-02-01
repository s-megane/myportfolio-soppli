@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">
    <div class="row justify-content-center">
    <h2>試合詳細</h2>
        <div class="col-sx-6 col-md-12 mt-3">
            {!! Form::model($game , ['route' => ['games.update', $game->id], 'method' => 'put']) !!}
            
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-5">    
                            <h4>{!! Form::label("title" , "試合:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-5">
                            <h4>{!! Form::text("title", null, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-5">    
                            <h4>{!! Form::label("opponent" , "対戦チーム:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-5">
                            <h4>{!! Form::text("opponent", null, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-5">    
                            <h4>{!! Form::label("myscore" , "自チーム点数:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-5">
                            <h4>{!! Form::text("myscore", null, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class = "row">
                        <div class = "col-sx-6 col-md-5">    
                            <h4>{!! Form::label("oppscore" , "対戦チーム点数:") !!}</h4>
                        </div>
                        <div class = "col-sx-6 col-md-5">
                            <h4>{!! Form::text("oppscore", null, ["class" => "form-control"]) !!}</h4>
                        </div>
                    </div>
                </div>
        </div>
        <div class = "col-sx-12 col-md-12">
            {!! Form::submit('更新', ['class' => 'btn mybtn']) !!}
        {!! Form::close() !!}    
        </div>
    </div>
    
</div>
@endsection