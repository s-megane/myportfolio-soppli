<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GradesService;
use App\Game;
use App\Http\Requests\valiRequest;
class GradesController extends Controller
{
    //参加した大会に関連する試合一覧を表示する
    public function index (GradesService $grades)
    {
      $events = $grades->getdata();
      return view('grades.index' ,compact('events'));
    }
    //成績を登録、修正(更新)する
    public function edit (GradesService $grades,$id)
    {
      $user = \Auth::user();
      $game = Game::findorfail($id);
      return view('grades.edit' , compact('user' , 'game'));
    }
    //成績の更新処理(中間テーブルusers_gamesの値を更新する)
    public function update (GradesService $grades , valiRequest $request,$id)
    {
        $game = Game::findorfail($id);
        
        $data = [
            'at_bat' => $request->at_bat,
            'hits' => $request->hits,
            'hr' => $request->hr,
            'rbi' => $request->rbi,
            'steal' => $request->steal,
            'winlose' => $request->winlose,
            'innings' => $request->innings,
            'conceded' => $request->conceded,
            'strikeout' => $request->strikeout,];
            \Auth::user()->usergames()->updateExistingPivot($game->id ,$data);
            return redirect()->action('GradesController@index', [\Auth::id()]);
    }
    //成績の登録処理(中間テーブルusers_gamesに保存する)
    public function store (GradesService $grades , valiRequest $request,$id)
    {
        $game = Game::findorfail($id);
        $data = [
            'at_bat' => $request->at_bat,
            'hits' => $request->hits,
            'hr' => $request->hr,
            'rbi' => $request->rbi,
            'steal' => $request->steal,
            'winlose' => $request->winlose,
            'innings' => $request->innings,
            'conceded' => $request->conceded,
            'strikeout' => $request->strikeout,];
            //中間テーブルに自分のデータがなければ保存する
            if(!\Auth::user()->is_games($game->id)){
                \Auth::user()->usergames()->attach($game->id ,$data);
                return redirect()->action('GradesController@index', [\Auth::id()]);
            }
        
    }
    
    
    
}
