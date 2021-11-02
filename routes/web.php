<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'home', 'uses' => function(){
    return view('home');
}]);

Route::get('/activity/home/{msg?}', ['as' => 'activity.home', 'uses' => 'App\Http\Controllers\ActivityController@home'])->middleware('auth');

Route::get('/activity/register/{msg?}', ['as' => 'activity.register', 'uses' => 'App\Http\Controllers\ActivityController@registerActivity'])->middleware('auth');

Route::post('/activity/create', ['as' => 'activity.create', 'uses' => 'App\Http\Controllers\ActivityController@createActivity']);

Route::get('/user/home/{msg?}', ['as' => 'user.home', 'uses' => 'App\Http\Controllers\UserController@home']);

Route::get('/user/logout', ['as' => 'user.logout', 'uses' => 'App\Http\Controllers\UserController@logout']);

Route::get('/user/register/{msg?}', ['as' => 'user.register', 'uses' => 'App\Http\Controllers\UserController@registerAccount']);

Route::post('/user/create', ['as' => 'user.create', 'uses' => 'App\Http\Controllers\UserController@createAccount']);

Route::post('/user/entry', ['as' => 'user.entry', 'uses' => 'App\Http\Controllers\UserController@entry']);