<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('main');
});


Route::get('/product', 'ProductController@index');
Route::post('/product', 'ProductController@store');

Route::get('/product/{id}', 'ProductController@show');
Route::post('/product/{id}', 'ProductController@update');
Route::delete('/product/{id}', 'ProductController@delete');
