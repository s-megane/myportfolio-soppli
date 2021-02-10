<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use App\Event;
class GoogleCalendarController extends Controller
{
    public function store(){
        
        $Event = Event::first();
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);
        $calendarId = 'nihonniegaowo@gmail.com';
        //dd($Event->deadlinedate);
        $event = new Google_Service_Calendar_Event(array(
            //タイトル
            'summary' => 'メール連絡する',
            'start' => array(
                // 開始日時
                'dateTime' => $Event->deadlinedate.'T11:00:00',
                'timeZone' => 'Asia/Tokyo',
            ),
            'end' => array(
                // 終了日時
                'dateTime' => $Event->deadlinedate.'T12:00:00',
                'timeZone' => 'Asia/Tokyo',
            ),
        ));
        $event = $service->events->insert($calendarId, $event);
        echo "イベントを追加しました";
        return back();
     }
     
     private function getClient()
    {
        $client = new Google_Client();

        //アプリケーション名
        $client->setApplicationName('GoogleCalendarAPIのテスト');
        //権限の指定
        $client->setScopes(Google_Service_Calendar::CALENDAR_EVENTS);
        //JSONファイルの指定
        $client->setAuthConfig(storage_path('app/json/moonlit-casing-301406-1ecf18fc1f64.json'));

        return $client;
    }
}
