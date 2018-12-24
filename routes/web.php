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

Route::get('/',[
    'uses' => 'UserController@create',
    'as' => 'home'
]);

Route::get('/game/{text}',[
    'uses' => 'UserController@singletext',
    'as' => 'singletext'
]);

Route::post('register',[
    'uses' => 'UserController@signup',
    'as' => 'register'
]);
Route::get('logout',[
    'uses' => 'UserController@destroy',
    'as' => 'logout'
]);
Route::get('login',[
    'uses' => 'UserController@signin',
    'as' => 'login'
]);
Route::post('login',[
    'uses' => 'UserController@login',
    'as' => 'attmplogin'
]);
Route::get('text','TextController@gettext');
Route::get('game',[
    'uses' => 'UserController@generate',
    'as' => 'generate'
]);
