    <div class = "text-center">
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active list_item" id="tab-menu-1"
                        data-toggle="list" href="#tab-content-1"
                        role="tab" aria-controls="tab-content-1">{{$now}}年</a>
                    <a class="list-group-item list-group-item-action" id="tab-menu-2"
                        data-toggle="list" href="#tab-content-2"
                        role="tab" aria-controls="tab-content-2">{{$now-1}}年</a>
                    <a class="list-group-item list-group-item-action" id="tab-menu-3"
                        data-toggle="list" href="#tab-content-3"
                        role="tab" aria-controls="tab-content-3">{{$now-2}}年</a>
                </div>
            </div>
            <div class="col-sm-9 col-mb-9">
                <h1>チーム年間成績</h1>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="tab-content-1"　role="tabpanel" aria-labelledby="tab-menu-1">
                        <h4>
                            @if($getyear->isEmpty())
                                <h4>{{$now}}年の試合情報はありません</h4>
                            @else
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>大会名</th>
                                            <th>試合</th>
                                            <th>対戦チーム</th>
                                            <th>スコア</th>
                                            <th>試合結果</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getyear as $event)
                                            @foreach($event->games()->get() as $game)
                                                <tr>
                                                    <td>{{$event->eventdate}}</td>
                                                    <td>{{$event->title}}</td>
                                                    <td>{!! link_to_route('games.details', $game->title, [$game->id], ['class' => 'mylink', ]) !!}</td>
                                                    <td>{{$game->opponent}}</td>
                                                    <td>{{$game->myscore}}-{{$game->oppscore}}</td>
                                                    <td>{{$game->result($game->myscore ,$game->oppscore)}}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <h2>{{$game->win_lose($now,'>')}}勝{{$game->win_lose($now,'<')}}敗{{$game->win_lose($now,'=')}}分</h2>
                                    </tbody>
                                </table>
                            @endif
                        </h4>
                    </div>
                
                    <div class="tab-pane fade" id="tab-content-2" role="tabpanel" aria-labelledby="tab-menu-2">
                        <h4>
                            @if($getbefore->isEmpty())
                                <h4>{{$now-1}}年の試合情報はありません</h4>
                            @else    
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>大会名</th>
                                            <th>試合</th>
                                            <th>対戦チーム</th>
                                            <th>スコア</th>
                                            <th>試合結果</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getyear as $event)
                                            @foreach($event->games()->get() as $game)
                                                <tr>
                                                    <td>{{$event->eventdate}}</td>
                                                    <td>{{$event->title}}</td>
                                                    <td>{!! link_to_route('games.details', $game->title, [$game->id], ['class' => 'mylink', ]) !!}</td>
                                                    <td>{{$game->opponent}}</td>
                                                    <td>{{$game->myscore}}-{{$game->oppscore}}</td>
                                                    <td>{{$game->result($game->myscore ,$game->oppscore)}}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <h2>{{$game->win_lose($now-1,'>')}}勝{{$game->win_lose($now-1,'<')}}敗{{$game->win_lose($now-1,'=')}}分</h2>
                                    </tbody>
                                </table>
                            @endif    
                        </h4>
                    </div>
                
                    <div class="tab-pane fade" id="tab-content-3" role="tabpanel" aria-labelledby="tab-menu-3">
                        <h4>
                            @if($getago->isEmpty())
                                <h4>{{$now-2}}年の試合情報はありません</h4> 
                            @else
                                <table class="table table-border">
                                    <thead>
                                        <tr>
                                            <th>日付</th>
                                            <th>大会名</th>
                                            <th>試合</th>
                                            <th>対戦チーム</th>
                                            <th>スコア</th>
                                            <th>試合結果</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getyear as $event)
                                            @foreach($event->games()->get() as $game)
                                                <tr>
                                                    <td>{{$event->eventdate}}</td>
                                                    <td>{{$event->title}}</td>
                                                    <td>{!! link_to_route('games.details', $game->title, [$game->id], ['class' => 'mylink', ]) !!}</td>
                                                    <td>{{$game->opponent}}</td>
                                                    <td>{{$game->myscore}}-{{$game->oppscore}}</td>
                                                    <td>{{$game->result($game->myscore ,$game->oppscore)}}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                        <h2>{{$game->win_lose($now-2,'>')}}勝{{$game->win_lose($now-2,'<')}}敗{{$game->win_lose($now-2,'=')}}分</h2>
                                    </tbody>
                                </table>
                            @endif    
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

