<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GradesService;
use Carbon\Carbon;
use App\User;
use App\Http\Requests\valiRequest;
class GradesController extends Controller
{
    public function index (GradesService $grades)
    {
      $events = $grades->getdata();
      return view('grades.index' ,compact('events'));
    }
    
    public function edit (GradesService $grades,$id)
    {
      $user = $grades->getauthuser();
      $game = $grades->getgame($id);
      return view('grades.edit' , [
          'user' => $user,
          'game' => $game,
          ]);
    }
    
    public function update (GradesService $grades , valiRequest $request,$id)
    {
        $game = $grades->getgame($id);
        
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
    
    public function store (GradesService $grades , valiRequest $request,$id)
    {
        $game = $grades->getgame($id);
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
            if(!\Auth::user()->is_games($game->id)){
                \Auth::user()->usergames()->attach($game->id ,$data);
                return redirect()->action('GradesController@index', [\Auth::id()]);
            }
        
    }
    
    
    
}
