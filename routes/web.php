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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/logout', 'Auth\LoginController@logout')->name('out');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/api/message/{id}', 'PostController@getMsg')->name('getMsg');
Route::get('/error', 'PostController@errors')->name('home');
Route::get('/chat', 'PostController@tchat')->name('tchat');
Route::get('/general', 'PostController@index')->name('event');
Route::get('/group', 'PostController@group')->name('event');
Route::post('/group', 'PostController@postGroup')->name('groupevent');
