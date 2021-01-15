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
        //全ユーザーの中から登録のないユーザー一覧を取得
        $users = User::whereNotIn('id', $exists)->get();
        $to = $users->pluck('email')->toArray();
        Mail::to($to)->send(new SendMail($event));
        
        // $email = $users->pluck('email');
        // $name = $users->pluck('name');
        // $tos = [$email,$name];
        
        //Mail::to($to)->send(new SendMail($event)); 
        
        
        
        return redirect('/admin');
    }
    
    
    	    
    
}
