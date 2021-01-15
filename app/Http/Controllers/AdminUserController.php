<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
class AdminUserController extends Controller
{
    public function edit($id) {
        $Aduser = User::findOrFail($id);
        return view("AdminUser.edit", [
            "Aduser" => $Aduser,    
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // idの値でメッセージを検索して取得
        $user = User::findOrFail($id);
        // メッセージを更新
        $user->role = $request->role;
        $user->save();

        // トップページへリダイレクトさせる
        return redirect("/admin");
    }
    
    public function destroy($id)
    {
        $adminUser = \Auth::user();
        $role = $adminUser->role;
        $user = User::findOrFail($id);
        
        if ($role === 1){
           $user->delete();
        }
            //session()->flash('flash_message', '退部しました。今までお世話になりました。');
            return redirect("/admin");
       
    }
}
