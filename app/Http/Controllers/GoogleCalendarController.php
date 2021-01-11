<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use App\Event;
class GoogleCalendarController extends Controller
{
     public function index(){

      $Cevents = Event::get(); // 未来の全イベントを取得する

        foreach ($Cevents as $event) {

            dump(
                $Cevents->id, // カレンダーID
                $Cevents->name, // タイトル
                $Cevents->description, // 説明文
                $Cevents->startDateTime, // 開始日時
                $Cevents->endDateTime // 終了日時
            );

        }
     }
}
