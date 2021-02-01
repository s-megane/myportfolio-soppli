@extends('layouts.app')

@section('content')
    <div class="row justify-content-around">
        <div class = "col-sm-12 col-xl-6">
            <div class = "mb-1 border border-danger rounded-pill">
                <div class = "text-center">
                    <div class="d-flex justify-content-around">
                        <h1 class = "offset-sm-Auto col-sm-Auto display-3">{{ $user->mynum }}</h1>
                        <h1 class ="col-sm-Auto align-self-center">{{ $user->name }}</h1>
                    </div>
                    <div class="d-flex justify-content-center">
                        @if($user->role ==1)
                            <span><h4 class ="col align-self-center">(監督)</h4></span>
                        @elseif($user->role ==2)
                            <span><h4 class ="col align-self-center">(キャプテン)</h4></span>
                        @endif
                        <h4 class = "offset-sm-3 mr-2">{{$user->user_age()}}歳</h4>
                        <h4>{{ $user->dominant_def }}/{{ $user->dominant_bat }}</h4>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <div class = "row justify-content-center">    
        <div class = "col-sm-6 col-md-Auto">
            <div class = "text-center">
                <div class = 'd-flex justify-content-between'>
                    @if($prev == null)
                        <span></span>
                    @else
                        <span class = "mr-Auto prev">{!! link_to_route("users.show" , '前のメンバーへ' , ['user' => $prev->id],['class' => 'mylink']) !!}</span>
                    @endif
                    @if(Auth::user()->role <= 2)
                        <a class = 'mylink' href="/admin" >戻る</a>
                    @else
                        <a class = 'mylink' href="/">戻る</a>
                    @endif
                    @if($next == null)
                        <span></span>
                    @else
                        <span class = "ml-Auto next">{!! link_to_route("users.show" , '次のメンバーへ' , ['user' => $next->id],['class' => 'mylink']) !!}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class = "row justify-content-center">    
        <div class = "col-sm-6 col-md-Auto">
            <div class = "text-center">
                <div class = "ml-2">
                    @if(Auth::id() === $user->id)
                        <span>{!! link_to_route('users.edit', 'プロフィール編集', [ $user->id], ['class' => 'btn mybtn']) !!}</span>
                    @endif
                    @if(Auth::user()->is_evaluations($user->id))
                        <span>{!! link_to_route('evaluation.edit' , '評価を変更する!' , [$user->id] ,['class' => 'btn mybtn']) !!}</span>
                        <P>{{$user->name}}さんの事はすでに評価済みです</P>
                    @else
                        @if($user->id === \Auth::id())
                            <span>{!! link_to_route('evaluation.edit' , '自己評価する!' , [$user->id] ,['class' => 'btn mybtn']) !!}</span>
                        @else
                            <span>{!! link_to_route('evaluation.edit' , 'この選手を評価する!' , [$user->id] ,['class' => 'btn mybtn']) !!}</span>
                        @endif
                    @endif
                    @if($user->id === \Auth::id())
                        {!! link_to_route('grades.index', '成績を入力する', [$user->id], ['class' => 'btn mybtn']) !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include("evaluations.show")
    <div class = "row justify-content-center">
        <div class = "col-sm-Auto col-mb-Auto">
            <div class = "mt-2">
                <div class ="text-center">
                    <h1>個人成績</h1>
                    <div class = 'mt-4'></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class = "row justify-content-around">
        <div class = "col-sm-12 col-mb-12">
            <div class = "mt-2">
                <div class ="text-center">
                    <div class = 'mb-4'>試合別</div>
                        <ul class="nav nav-tabs justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="item1-tab" data-toggle="tab" href="#item1" role="tab" aria-controls="item1" aria-selected="true">野手成績</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="item2-tab" data-toggle="tab" href="#item2" role="tab" aria-controls="item2" aria-selected="false">投手成績</a>
                            </li> 
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="item1" role="tabpanel" aria-labelledby="item1-tab">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>大会名</th>
                                            <th>対戦チーム</th>
                                            <th>打席数</th>
                                            <th>安打数</th>
                                            <th>打率</th>
                                            <th>HR</th>
                                            <th>打点</th>
                                            <th>盗塁</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($data as $game)
                                                <tr>
                                                    <td>{{$game->event()->first()->eventdate}}</td>
                                                    <td>{{$game->event()->first()->title}}</td>
                                                    <td>{{$game->opponent}}</td>
                                                    <td>{{$game->pivot->at_bat}}</td>
                                                    <td>{{$game->pivot->hits}}</td>
                                                    <td>{{$user->getaverage($game->id)}}</td>
                                                    <td>{{$game->pivot->hr}}</td>
                                                    <td>{{$game->pivot->rbi}}</td>
                                                    <td>{{$game->pivot->steal}}</td>
                                                </tr>
                                            @endforeach
                                    </tbody> 
                                </table>
                                <div class = 'mb-4'>年間成績({{$year}})</div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>出場試合数</th>
                                            <th>打席数</th>
                                            <th>安打数</th>
                                            <th>打率</th>
                                            <th>HR</th>
                                            <th>打点</th>
                                            <th>盗塁</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$user->getmyCount($year,$opponent)}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.at_bat')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.hits')}}</td>
                                            <td>{{$user->totalaverage($year,$opponent,'.hits','.at_bat')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.hr')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.rbi')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.steal')}}</td>
                                        </tr>
                                    </tbody> 
                                </table> 
                              
                            </div>
                            <div class="tab-pane fade" id="item2" role="tabpanel" aria-labelledby="item2-tab">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>大会名</th>
                                            <th>対戦チーム</th>
                                            <th>勝敗</th>
                                            <th>投球回</th>
                                            <th>失点</th>
                                            <th>防御率</th>
                                            <th>奪三振</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $game)
                                            <tr>
                                                <td>{{$game->event()->first()->eventdate}}</td>
                                                <td>{{$game->event()->first()->title}}</td>
                                                <td>{{$game->opponent}}</td>
                                                <td>{{$game->pivot->winlose}}</td>
                                                <td>{{$game->pivot->innings}}</td>
                                                <td>{{$game->pivot->conceded}}</td>
                                                <td>{{$user->geteraverage($game->id)}}</td>
                                                <td>{{$game->pivot->strikeout}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody> 
                                </table> 
                                <div class = 'mb-4'>年間成績({{$year}})</div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>登板</th>
                                            <th>勝利数</th>
                                            <th>敗戦数</th>
                                            <th>投球回</th>
                                            <th>失点</th>
                                            <th>防御率</th>
                                            <th>奪三振</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$user->getPcount($year,$opponent)}}</td>
                                            <td>{{$user->getwinlose($year,$opponent,'勝')}}</td>
                                            <td>{{$user->getwinlose($year,$opponent,'敗')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.innings')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.conceded')}}</td>
                                            <td>{{$user->totalerave($year,$opponent,'.innings','.conceded')}}</td>
                                            <td>{{$user->totalSum($year,$opponent,'.strikeout')}}</td>
                                        </tr>
                                    </tbody> 
                                </table> 
                            </div>
                        </div>    
                    </div>            
                </div>
            </div>
        </div>
    </div>
    <div class = "row justify-content-around">
        <div class = "col-sm-Auto col-mb-Auto">
            <div class = "d-flex justify-content-center">
                <button type="button" class="btn mybtn" data-toggle="modal" data-target="#modal1">検索フォーム</button>
                <div class = "ml-2">
                    {!! Form::open(["route" => ["users.show" , 'user' => $user->id], "method" => "get"]) !!}
                        {!! Form::submit('元に戻す', ['class' => 'btn mybtn3']) !!}
                    {!! Form::close() !!} 
                </div>
                </button>
            </div>
            
            <div class="modal fade" id="modal1" tabindex="-1">
                <div class = "row justify-content-center">
                    <div class = 'col-xl-8 col-sm-Auto'>
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="label1">成績の詳細データ検索</h5>
                                </div>
                                <div class="modal-body">
                                    {!! Form::open(["route" => ["users.show" , $user->id], "method" => "get"]) !!}
                                        <div class="form-group">
                                            {!! Form::label('getyear', '年別で検索') !!}
                                            {!! Form::text('getyear', '' , ['class' => 'form-control']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('getopponent', '対戦チーム別検索') !!}
                                            {!! Form::text('getopponent', '' , ['class' => 'form-control']) !!}
                                        </div>
                                        {!! Form::submit('検索', ['class' => 'btn mybtn']) !!}
                                    {!! Form::close() !!}
                                    <div class = 'mb-2'></div>
                                    {!! Form::open(["route" => ["users.show" , $user->id], "method" => "get"]) !!}
                                        {!! Form::submit('元に戻す', ['class' => 'btn mybtn3']) !!}
                                    {!! Form::close() !!}        
                                </div> 
                                <div class="modal-footer">
                                    <button type="button" class="btn mybtn2" data-dismiss="modal">Close</button>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "m-4">
        <div class = "row justify-content-center">
            <div class="d-flex justify-content-around">
                <div class = "col-sm-6 col-mb-Auto">
                    <div class = "mr-2">
                        
                    </div>
                </div>
                <div class = "col-sm-6 col-mb-Auto">
                    <div class = "mr-2">
                        @if (\Auth::user()->role <= 2)
                            {!! link_to_route('adminuser.edit', '権限を変更する', [$user->id], ['class' => 'btn btn-light']) !!}
                        @endif 
                    </div>
                </div>
                <div class = "col-sm-6 col-mb-Auto">
                    <div class = "ml-2">
                        @if (\Auth::user()->role === 1)
                            {!! Form::open(['route' => ['adminuser.destroy', $user->id] ,'method' => 'delete']) !!}
                                {!! Form::submit('このメンバーを削除する', ['class' => "btn btn-danger"]) !!}
                            {!! Form::close() !!}
                        @endif 
                    </div>
                </div> 
            </div>
        </div>
    </div>    
@endsection