<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;

class MoviesApiController extends Controller
{
    public function listMovies(Request $request, MovieService $movieService)
    {
        
    }
}
