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
    public function details($id)
    {
        $game = Game::findOrFail($id);
        
        return view('games.details' , [
               'game' => $game,
            ]);
    }
     
    public function index() 
    {
        $users = User::all();
        $events = Event::orderBy('created_at','desc')->get();
        $Event = Event::first();
        $games = Game::all();
        return view('games.index' , [
               'games' => $games,
               'events' => $events,
               'Event' => $Event,
               'users' => $users,
            ]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);
        $games = $event->games()->get();
        
        return view('games.show' , [
                "games" => $games ,   
                "event" => $event,
            ]);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(valiRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->fill($request->all())->save();
        $event = $game->event()->first();
        
        return redirect()->action("GamesController@show",[$event->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
