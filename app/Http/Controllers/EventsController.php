<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use App\Event;
use App\User;
use App\Game;
use DB;
class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [] ;
        if (\Auth::check()){
            $events = Event::take(5)->orderBy("created_at" ,"desc")->paginate(5);
            $users = User::orderBy("role")->paginate(10);
            $game = Game::take(1)->orderBy("created_at" , "desc");
            $data = [
                "users" => $users ,
                "events" => $events ,
                "game" => $game,
            ];
        }
        return view("welcome" , $data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event;
        return view('events.create', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //イベントデータ作成
        $event = new Event;
        $event->fill($request->all())->save();
        
        
        //作成イベントデータのidを取得
        $eventId = $event->id;
        //作成イベントのタイトルを取得
        $title = $event->title;
        if($title == "練習"||$title == "親睦会" )
        {
        }else{
            
            //1大会につき2試合
            $gamecounts = ['第1試合' , '第2試合'];
            //gamesテーブルに2試合分のデータ登録
            foreach ($gamecounts as $gamecount){
                $game = new Game;
                $game->event_id = $eventId;
                $game->title = $gamecount;
                $game ->save();
            }    
        }
       return redirect()->action('EventsController@show' , [$event->id]);
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
        $exists = $event->attendances()->pluck('user_id')->toArray();
        $users = User::whereNotIn('id', $exists)->get();
        return view("events.show" , compact("event" , "users" , "exists"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if (\Auth::user()->role <= 2){
            return view("events.edit" ,compact("event")); 
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        if (\Auth::user()->role <= 2){
            $event = Event::findOrFail($id);
            // $event->eventdate = $request->eventdate;
            // $event->title = $request->title;
            // $event->place = $request->place;
            // $event->meetingtime = $request->meetingtime;
            // $event->deadlinedate = $request->deadlinedate;
            $event->fill($request->all())->save();
            return redirect()->action('EventsController@show' , [$event->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if (\Auth::user()->role <= 2){
           $event->delete();
           return redirect("/admin");
        }
            
            
    }
}
