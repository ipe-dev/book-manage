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

Route::get('/book/list', 'BookController@list')->middleware('auth');

Route::get('/book/detail/{book}', 'BookController@detail')->middleware('auth');

Route::get('/book/entry', 'BookController@entry')->middleware('auth');
Route::post('/book/create', 'BookController@create');

Route::get('/book/edit/{book}', 'BookController@edit')->middleware('auth');
Route::patch('/book/{book}', 'BookController@update');

Route::delete('/book/{book}', 'BookController@destroy');

Route::get('/book/login', 'BookController@getLogin');
Route::post('/book/login', 'BookController@postLogin');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
