<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Game;
use App\User;
use App\Http\Requests\valiRequest;
class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    //試合毎の個人成績一覧を表示し、関連する大会に参加していたら成績入力へ遷移するリンクを表示 
    public function details($id)
    {
        $game = Game::findOrFail($id);
        //選択した試合に関係するイベントを取得する
        $event = $game->event()->first();
        //取得したイベントに出欠回答をした自分を探す
        $attend = $event->attendances()->where('attendances.user_id' , \Auth::id())->first();
        //そのイベントに自分が存在したら
        if(!empty(\Auth::user()->is_attendance($event->id)))
        {
            //出欠の回答(ステータス)を取得する
            $status = $attend->pivot->status;
        }else
        {
            $status = '';
        }
        return view('games.details' , compact('game' , 'status'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //関連する大会から試合の詳細画面表示
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $games = $event->games()->get();
        return view('games.show' , compact('games', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //試合結果を入力する画面表示 
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        return view('games.edit' ,[
                "game" => $game,
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //試合結果の入力を反映する 
    public function update(valiRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->fill($request->all())->save();
        //リダイレクトのため、イベントid取得
        $event = $game->event()->first();
        return redirect()->action("GamesController@show",[$event->id]);
    }
}
