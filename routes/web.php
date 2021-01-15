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
        Route::post('mail', 'MailSendController@send')->name("mail.send");
    });
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::get("users" , "UsersController@userdelete")->name("user.delete");
    });
    Route::resource('users', 'UsersController');
    Route::resource('events' , "EventsController");
    Route::resource('attendances', 'AttendancesController');
    
    //Route::post("attendance" , 'AttendancesController@store');
    //Route::delete('users', 'UsersController@destroy')->name('users.destroy');
    
 });
Route::group (['middleware' => ['auth', 'can:admin']], function () {
	Route::get('/admin', 'AdminController@index');
	Route::group(['prefix' => 'users/{id}'], function () {
        Route::get("/admin/edit", "AdminUserController@edit")->name("adminuser.edit");
        Route::put("/admin/update" , "AdminUserController@update")->name("adminuser.update");
        Route::delete("/admin/delete" , "AdminUserController@destroy")->name("adminuser.destroy");
	});    
});
