<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@getIndex');
Route::get('/google/login', 'AuthController@getLogin');
Route::get('/google/logout', 'AuthController@getLogout');
Route::get('/google/callback', 'AuthController@getCallback');
Route::get('/text', 'ImageController@getText');
Route::post('/text', 'ImageController@updateText');
Route::post('/upload', 'ImageController@postUpload');