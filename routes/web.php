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

Route::get('/', 'BlogController@index');

Route::get('/blog/i_love_food', 'BlogController@iLoveFood');
Route::get('/blog/{article}', 'BlogController@article');

Route::get('/blog/officially_blogging', 'BlogController@officiallyBlogging');
Route::get('/show_comments', 'CommentsController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/comment', 'CommentsController@store');
