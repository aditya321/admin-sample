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

//Redirect to Login Page
Route::get('/', function () {
    return redirect('getLogin');
});

//Login
Route::post('postLogin', ['as' => 'login', 'uses' => 'Admin\AuthController@postLogin']);
Route::get('getRegister', ['as' => 'register', 'uses' => 'Admin\AuthController@getregister']);
Route::post('postRegister', ['as' => 'postRegister', 'uses' => 'Admin\AuthController@postregister']);
Route::get('getLogin', ['as' => 'getLogin', 'uses' => 'Admin\AuthController@getLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'Admin\AuthController@logout']);
