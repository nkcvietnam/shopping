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

/**
 * Default Route for Home Page
 */

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', 'HomeController@index')->name('home');
/**
 * Default Route for Authentication Page
 */

Route::get('register', 'HomeController@index')->name('register');
Route::get('backend/login', 'Backend\LoginController@showLoginForm')->name('backend-login');
Route::post('backend/login', 'Backend\LoginController@postLogin')->name('backend-post-login');
Route::get('backend/logout', 'Backend\LoginController@logOut')->name('backend-logout');

Route::get('backend/dashboard', 'Backend\AdminController@index')->name('backend-dashboard');

/**
 * Routing for User management
 */
Route::group(['prefix'=>'backend','middleware'=>'checkLogin'],function(){

    Route::get('/', ['as'=>'backend/index','uses'=>'Backend\AdminController@index']);

    Route::group(['prefix'=>'user'],function(){
        Route::get('/index', ['as'=>'backend.user.index','uses'=>'Backend\UserController@index']);
        Route::any('/create', ['as'=>'backend.user.create','uses'=>'Backend\UserController@create']);
        Route::any('/edit/{id}', ['as'=>'backend.user.edit','uses'=>'Backend\UserController@edit']);
        Route::any('/delete/{id}', ['as'=>'backend.user.delete','uses'=>'Backend\UserController@delete']);
        Route::any('/exportExcel', ['as'=>'backend.user.export','uses'=>'Backend\UserController@exportExcel']);
    });

});