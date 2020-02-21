<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MoviesApiController extends Controller
{
    /**
     * List all the available movies
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * @return Response
     */
    public function listMovies(Request $request, MovieService $movieService)
    {
        $movies = $movieService->allMovies();
        $data = view('movies.list', compact('movies'))->render();
        return $this->successResponse('Data was successfully fetched.', $data);
    }
}
