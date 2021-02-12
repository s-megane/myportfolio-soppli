<?php
namespace App\Services;
use App\Event;
use App\Game;
use App\User;
use App\Calendar;
use Carbon\Carbon;
use DB;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;


class EventService 
{
    public function getIndexData()
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
        return $data;
    }
    
    public function getCreateData($eventId)
    {
        //1大会につき2試合
        $gamecounts = ['第1試合' , '第2試合'];
        //gamesテーブルに2試合分のデータ登録
        foreach ($gamecounts as $gamecount){
            $game = new Game;
            $game->event_id = $eventId;
            $game->title = $gamecount;
            $game->save();
        }    
    }
    
    public function getCalendarData($eventdate,$deadlinedate,$eventtitle,$eventId)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = config('google-calendar.calendar_id');
        //dd($calendarId);
        $Cevent = new Google_Service_Calendar_Event(array(
            //タイトル
            'summary' => $eventdate.'開催の'.$eventtitle.'の出欠未確認者へメールする',
            'start' => array(
                // 開始日時
                'dateTime' => $deadlinedate.'T12:00:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ),
            'end' => array(
                // 終了日時
                'dateTime' => $deadlinedate.'T12:30:00+09:00',
                'timeZone' => 'Asia/Tokyo',
            ),
        ));
        //カレンダーに予定追加
        $Clendarevent = $service->events->insert($calendarId, $Cevent);
        //追加した予定のidを取得
        $CeventId = $Clendarevent->getId();
        //取得したデータをもとにDBへ保存
        $calendar = new Calendar;
        $calendar->event_id = $eventId;
        $calendar->Cevent_id = $CeventId;
        $calendar->save();
        //echo "イベントを追加しました";
        //return back();
    }
    
    private function getClient()
    {
        $client = new Google_Client();

        //アプリケーション名
        $client->setApplicationName('GoogleCalendarAPI');
        //権限の指定
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        //JSONファイルの指定
        $client->setAuthConfig(storage_path('json/moonlit-casing-301406-1ecf18fc1f64.json'));

        return $client;
    }
    
    public function updateCevent($deadlinedate , $id)
    {
        $gameevent = Event::findOrFail($id);
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = config('google-calendar.calendar_id');
        $Cevent_id = $gameevent->calendar->Cevent_id;
        $Cevent = $service->events->get($calendarId, $Cevent_id);
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDateTime($deadlinedate.'T12:00:00+09:00');  
        $Cevent->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDateTime($deadlinedate.'T12:30:00+09:00');  
        $Cevent->setEnd($end);
        $Clendarevent = $service->events->update($calendarId, $Cevent_id,$Cevent);
        
    }
    
    public function deleteCevent($id)
    {
        $gameevent = Event::findOrFail($id);
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = config('google-calendar.calendar_id');
        $Cevent_id = $gameevent->calendar->Cevent_id;
        $Cevent = $service->events->get($calendarId, $Cevent_id);
        $Clendarevent = $service->events->delete($calendarId, $Cevent_id);
        
    }
}
