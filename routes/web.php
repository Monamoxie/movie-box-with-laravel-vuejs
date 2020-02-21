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
    return redirect('/movies');
});

Route::get("/movies", "MoviesController@index");
Route::get("/movies/{slug}", "MoviesController@movieDetails");

Auth::routes();

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/logout', 'LoginController@logout');
});

Route::get('/home', 'HomeController@index')->name('home');
