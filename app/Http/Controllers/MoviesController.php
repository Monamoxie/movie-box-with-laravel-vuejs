<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    /**
     * Default landing page for all the available movies
     * @param App\Services\MovieService;
     * @return  
     */
    public function index()
    {
        return view('movies.landing');
    }
}
