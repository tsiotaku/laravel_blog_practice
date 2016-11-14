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



Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::any('admin/login', 'IndexController@login');
    Route::get('admin/code', 'Admin\LoginController@code');
    Route::get('admin/getcode', 'Admin\LoginController@getcode');
});