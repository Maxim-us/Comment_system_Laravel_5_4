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

Route::get('/blog/{article}', 'BlogController@article');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::post('/comment', 'CommentsController@store');
Route::get('/comment_logs', 'CommentsController@index');

// vote
Route::post('/vote', 'VotesController@index');
