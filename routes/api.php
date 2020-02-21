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

});