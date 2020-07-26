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

Route::get('/book/list', 'BookController@list');

Route::get('/book/detail/{book}', 'BookController@detail');

Route::get('/book/entry', 'BookController@entry');
Route::post('/book/create', 'BookController@create');

Route::get('/book/edit/{book}', 'BookController@edit');
Route::patch('/book/{book}', 'BookController@update');

Route::delete('/book/{book}', 'BookController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
