<?php

use Illuminate\Http\Request;

 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
// 
Route::group(['prefix' => 'v1', 'namespace' => 'Api',  ], function() {

    Route::post("/movies", "MoviesController@listMovies");
    Route::get("/movies/{id}", "MoviesController@movieDetails");
    Route::get("/login", "LoginController@login");
    
   
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post("/movies/store", "MoviesApiController@storeMovie");
    });

    
    Route::get("/movies/{slug}", "MoviesController@movieDetails");

Route::post("/movies/comment/store", "MoviesController@storeMovieComment")->middleware('auth');
Route::get("/movies/create/new", "MoviesController@createMovie")->middleware('auth');
Route::post("/movies/store", "MoviesController@storeMovie")->middleware('auth');

Auth::routes();

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/logout', 'LoginController@logout');
});

Route::get('/home', 'HomeController@index')->name('home');

});