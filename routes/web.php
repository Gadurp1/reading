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


Auth::routes();
Route::get('/', 'UserBookController@index');

Route::get('reading-list', 'UserBookController@index');
Route::delete('reading-list/{id}', 'UserBookController@destroy');

Route::put('reorder-list', 'UserBookController@update');

Route::get('books', 'BookController@index');
Route::post('books', 'BookController@store');

Route::get('/search', 'GoogleBookSearchController@search')->name('search');
Route::get('/searchs', 'GoogleBookSearchController@searchs');
Route::get('/google-books/{id}', 'GoogleBookSearchController@show');
