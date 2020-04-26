<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MoviesController extends Controller
{
    /**
     * List all the available movies
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * @return Response
     */
    public function listMovies(Request $request, MovieService $movieService)
    { 
        $movies = $movieService->allMovies();
        return $this->successResponse('Data was successfully fetched.', $movies);
    }

    /**
     * Returns full details of a movie
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * @return Response
     */
    public function movieDetails(Request $request, MovieService $movieService)
    {   
        $movieDetails = $movieService->movieDetails(preg_replace('#[^a-z0-9-]#i', '', $request->id));

            return $movieDetails->movie !== null ?
                $this->successResponse('Data was successfully fetched.', $movieDetails) : 
                $this->errorResponse('An error occured'); 
    }

    
}
