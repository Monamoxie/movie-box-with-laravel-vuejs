<?php

use Illuminate\Http\Request;

 
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
// 
Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function() {

    Route::post("/movies", "MoviesController@listMovies");
    Route::get("/movies/{id}", "MoviesController@movieDetails");
    Route::post("/login", "LoginController@login");
    Route::post("/register", "RegisterController@register");
    Route::post('/logout', 'LogoutController@logout')->middleware('auth:api');

   
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post("/movie/{id}/comment/new", "MoviesController@newComment");
        Route::post("/movies/new", "MoviesController@newMovie");
    });
 
});