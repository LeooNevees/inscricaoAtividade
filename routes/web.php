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

/** Usuário... */
Route::group(['prefix' => 'user'], function () {

    /** Tela Home para acesso do usuário... */
    Route::get('home', ['as' => 'user.home', 'uses' => function(){
        return view('user');
    }]);

    /** Rota responsável para realizar logout do usuário atual... */
    Route::get('logout', ['as' => 'user.logout', 'uses' => 'App\Http\Controllers\UserController@logout']);

    /** Tela para cadastro de novo usuário... */
    Route::get('register', ['as' => 'user.register', 'uses' => function(){
        return view('registerUser');
    }]);

    /** Rota responsável pela validação dos dados fornecidos para cadastro do novo usuário... */
    Route::post('create', ['as' => 'user.create', 'uses' => 'App\Http\Controllers\UserController@createAccount']);

    /** Rota responsável pela validação do login ... */
    Route::post('entry', ['as' => 'user.entry', 'uses' => 'App\Http\Controllers\UserController@entry']);
});

/** Atividade... */
Route::group(['prefix' => 'activity', 'middleware' => 'auth'], function () {

    /** Tela Home para acesso das atividades... */
    Route::get('home/{msg?}', ['as' => 'activity.home', 'uses' => 'App\Http\Controllers\ActivityController@home']);

    /** Tela para cadastro de nova atividade... */
    Route::get('register', ['as' => 'activity.register', 'uses' => function(){
        return view('registerActivity');
    }]);

    /** Rota responsável em inativar atividade... */
    Route::get('inactivate/{id}', ['as' => 'activity.inactivate', 'uses' => 'App\Http\Controllers\ActivityController@InactivateActivity']);

    /** Rota responsável pela validação dos dados fornecidos para cadastro da nova atividade... */
    Route::post('create', ['as' => 'activity.create', 'uses' => 'App\Http\Controllers\ActivityController@createActivity']);
});

/** Inscrição... */
Route::group(['prefix' => 'registration', 'middleware' => 'auth'], function () {
    
    /** Rota responsável pela validação dos dados fornecidos para inscrição entre usuário e atividade... */
    Route::get('/registration/{id?}', ['as' => 'registration.userRegistration', 'uses' => 'App\Http\Controllers\RegistrationController@userRegistration']);
});