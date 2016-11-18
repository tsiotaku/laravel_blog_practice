<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
        return view('welcome');
    });

Route::group(['prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::any('login', 'LoginController@login');
    Route::get('code', 'LoginController@code');
    Route::get('getcode', 'LoginController@getcode');
});

Route::group(['middleware' => ['admin.login'],'prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::any('pass', 'IndexController@pass');
    Route::get('quit', 'LoginController@quit');
    Route::resource('category','CategoryController');
});