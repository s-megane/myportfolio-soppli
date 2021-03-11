<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Event;
use App\User;
use DB;
use App\Mail\SendMail;
class MailSendController extends Controller
{
    public function send($id)
    {
        $event = Event::findOrFail($id);
        //選択したイベントに登録のあるユーザーを選択
        $exists = $event->attendances()->pluck('user_id')->toArray();
        //全ユーザーの中から登録のないユーザー(未回答者)一覧を取得
        $users = User::whereNotIn('id', $exists)->get();
        //未回答者のアドレスを配列にする
        $to = $users->pluck('email')->toArray();
        //未回答者にメールを送信する
        Mail::to($to)->send(new SendMail($event));
        return view('emails.send');
    }
    
    
    	    
    
}
