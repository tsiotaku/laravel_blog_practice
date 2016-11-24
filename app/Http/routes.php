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

    Route::post('cate/changeorder', 'CategoryController@changeOrder');
    Route::resource('category','CategoryController');

    Route::resource('article','ArticleController');
    Route::any('uploadimg','ArticleController@article_upload_image');

    Route::post('link/changeorder', 'LinkController@changeOrder');
    Route::resource('link','LinkController');

    Route::post('nav/changeorder', 'NavController@changeOrder');
    Route::resource('nav','NavController');

    Route::resource('config','ConfigController');
    Route::post('config/changeorder', 'ConfigController@changeOrder');
    Route::post('config/changecontent', 'ConfigController@changeContent');
});