<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * This will just return a skeleton. The actual content will be called up by Axios asynchronously
     */
    public function movieDetails(Request $request)
    {

        return view('movies.details_skeleton', [
            'slug' => $request->slug,
            'userStatus' => Auth::check()
        ]);
    }
}
