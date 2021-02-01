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

//Route::get('/', function () {
    ////return view('welcome');
//});
Route::get('/', 'EventsController@index');


// ユーザ登録
//Route::resource('/', 'GoogleCalendarController');
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get'); 

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'events/{id}'], function () {
        Route::post('attendance' , 'AttendancesController@store')->name("attendance.store");
        Route::put("attendance" , "AttendancesController@update")->name("attendance.update");
        Route::get("attendances" , "AttendancesController@attendances")->name("attendances");
    });
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get("users" , "UsersController@userdelete")->name("user.delete");
        Route::post("evaluation" , "EvaluationController@store")->name("evaluation.store");
        Route::put("evaluation" , "EvaluationController@update")->name("evaluation.update");
        Route::get("evaluation" , "EvaluationController@show")->name("evaluation.show");
        Route::get("evaluation" , "EvaluationController@edit")->name("evaluation.edit");
        Route::put("grades" , "GradesController@update")->name("grades.update");
        Route::get("grades" , "GradesController@show")->name("grades.show");
        Route::get("grades/games" , "GradesController@edit")->name("grades.edit");
        Route::get("grades" , "GradesController@index")->name("grades.index");
        Route::post("grades" , "GradesController@store")->name("grades.store");
        Route::put("grades" , "GradesController@update")->name("grades.update");
    });
    Route::resource('users', 'UsersController');
    Route::get('ranking', 'UsersController@ranking')->name('ranking');
    Route::resource('events' , "EventsController");
    Route::resource('attendances', 'AttendancesController');
    Route::get("grades/games/{id}" , "GradesController@edit")->name("grades.edit");
    Route::resource('games', 'GamesController');
    Route::get('games', 'GamesController@index')->name('games.index');
    Route::get('games/events/{id}', 'GamesController@show')->name('games.show');
    Route::get('gamesresult/{id}', 'GamesController@edit')->name('games.edit');
    Route::get('gamesdata/{id}', 'GamesController@details')->name('games.details');
    Route::put('games/{id}', 'GamesController@update')->name('games.update');
 });
Route::group (['middleware' => ['auth', 'can:admin']], function () {
	Route::get('/admin', 'AdminController@index');
	Route::get("events", "EventsController@create")->name("events.create");
	Route::post("events", "EventsController@store")->name("events.store");
	
	Route::group(['prefix' => 'users/{id}'], function () {
        Route::get("/admin/edit", "AdminUserController@edit")->name("adminuser.edit");
        Route::put("/admin/update" , "AdminUserController@update")->name("adminuser.update");
        Route::delete("/admin/delete" , "AdminUserController@destroy")->name("adminuser.destroy");
        Route::post("evaluation" , "EvaluationController@store")->name("evaluation.store");
        Route::put("evaluation" , "EvaluationController@update")->name("evaluation.update");
        Route::get("evaluation" , "EvaluationController@show")->name("evaluation.show");
        Route::get("evaluation" , "EvaluationController@edit")->name("evaluation.edit");
        
	});
	
	Route::group(['prefix' => 'events/{id}'], function () {
	    Route::get('events','EventsController@show')->name('events.show');
	    Route::get("events", "EventsController@edit")->name("events.edit");
	    Route::put("events", "EventsController@update")->name("events.update");
	    Route::delete("events", "EventsController@destroy")->name("events.destroy");
	    Route::post('mail', 'MailSendController@send')->name("mail.send");
	    
	});
    Route::put('games/{id}', 'GamesController@update')->name('games.update');
    //
});
