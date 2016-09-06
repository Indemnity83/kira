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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/home/add', function() { return view('add'); });
Route::get('/home/add/new', function() { return view('artists.add'); });
Route::get('/home/add/create', function() { return view('artists.create'); });
Route::get('/home/add/import', function() { return view('artists.import'); });
Route::post('/artists', 'ArtistsController@create')->name('artists.create');
Route::get('/artists/{artist}', 'ArtistsController@show')->name('artists.show');
