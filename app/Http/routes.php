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

Route::any('admin/login', 'Admin\LoginController@login');


Route::group(['middleware' => ['web']], function () {
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::get('admin/getcode', 'Admin\LoginController@getcode');
});


Route::group(['middleware' => ['web','admin.login'],'prefix' => 'admin','namespace' => 'Admin'], function () {
    Route::get('index', 'IndexController@index');
    Route::get('info', 'IndexController@info');
    Route::any('pass', 'IndexController@pass');
    Route::get('quit', 'LoginController@quit');
});