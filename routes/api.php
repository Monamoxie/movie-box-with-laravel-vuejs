<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
 
//  
Route::group(['prefix' => 'v1', 'namespace' => 'Api',  ], function() {
    Route::post("/movies/list", "MoviesApiController@listMovies");
    Route::post("/movies/details", "MoviesApiController@getMovieDetails");
    
   
    Route::group(['middleware' => 'auth:api'], function () {
        Route::post("/movies/store", "MoviesApiController@storeMovie");
    });

    Route::get("/movies", "MoviesController@index");
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