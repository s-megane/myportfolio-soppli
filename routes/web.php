<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'EventsController@index');

// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get'); 

//ログインしたユーザーのみ
Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'events/{id}'], function () {
        //イベント詳細表示
        Route::get('event','EventsController@show')->name('events.show');
        //イベントへの出欠入力、更新
        Route::post('attendance' , 'AttendancesController@store')->name("attendance.store");
        Route::put("attendance" , "AttendancesController@update")->name("attendance.update");
    });
    Route::group(['prefix' => 'users/{id}'], function () {
        //ユーザー退会最終確認画面へのルーティング
        Route::get("users" , "UsersController@userdelete")->name("user.delete");
        //選手の評価に関するルーティング
        Route::post("evaluation" , "EvaluationController@store")->name("evaluation.store");
        Route::put("evaluation" , "EvaluationController@update")->name("evaluation.update");
        Route::get("evaluation" , "EvaluationController@edit")->name("evaluation.edit");
        //個人成績に関するルーティング
        Route::put("grades" , "GradesController@update")->name("grades.update");
        Route::get("grades/games" , "GradesController@edit")->name("grades.edit");
        Route::get("grades" , "GradesController@index")->name("grades.index");
        Route::post("grades" , "GradesController@store")->name("grades.store");
    });
    //プロフィール編集、退会処理など
    Route::resource('users', 'UsersController');
    //ランキング表示
    Route::get('ranking', 'UsersController@ranking')->name('ranking');
    //試合詳細の表示
    Route::get('gamesdata/{id}', 'GamesController@details')->name('games.details');
    
 });
 
//管理者のみ可能
Route::group (['middleware' => ['auth', 'can:admin']], function () {
    //管理者用トップ画面
	Route::get('/admin', 'AdminController@index');
	//イベントの新規作成
	Route::get("events", "AdminEventController@create")->name("events.create");
	Route::post("events", "AdminEventController@store")->name("events.store");
	Route::group(['prefix' => 'users/{id}'], function () {
	    //ユーザーの権限変更
        Route::get("/admin/edit", "AdminUserController@edit")->name("adminuser.edit");
        Route::put("/admin/update" , "AdminUserController@update")->name("adminuser.update");
        //ユーザーの強制退会
        Route::delete("/admin/delete" , "AdminUserController@destroy")->name("adminuser.destroy");
	});
	
	Route::group(['prefix' => 'events/{id}'], function () {
	    //イベントの変更、削除のルーティング
	    Route::get("events", "AdminEventController@edit")->name("events.edit");
	    Route::put("events", "AdminEventController@update")->name("events.update");
	    Route::delete("events", "AdminEventController@destroy")->name("events.destroy");
	   //出欠確認未回答者へのメール催促
	    Route::post('mail', 'MailSendController@send')->name("mail.send");
	});
	//対戦成績などの、試合詳細の変更
    Route::put('games/{id}', 'GamesController@update')->name('games.update');
    Route::get('games/events/{id}', 'GamesController@show')->name('games.show');
    Route::get('gamesresult/{id}', 'GamesController@edit')->name('games.edit');
});
