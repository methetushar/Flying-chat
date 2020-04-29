<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'authuser'],function (){
    Route::get('/', 'RegisterController@index');
    Route::get('/user-list','RegisterController@User');
    Route::get('/view-message/{id}','RegisterController@ViewMessage');
});
Route::get('/login','RegisterController@create');
Route::get('/register','RegisterController@create');
Route::post('/register-data','RegisterController@store')->name('RegisterData');
Route::post('/login-data','RegisterController@login');

Route::get('session',function (){
   return session()->get('authenticated');
});
Route::post('/send-message','MessageController@SendMessage');
