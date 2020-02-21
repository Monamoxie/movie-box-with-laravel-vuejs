<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MovieService;
use Carbon\Carbon;

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

    public function getMovieDetails(Request $request, MovieService $movieService)
    {
        $request->validate([
            'slug' => ['required', 'string', 'exists:movies']
        ]);

        $movieDetails = $movieService->movieDetails(preg_replace('#[^a-z0-9-]#i', '', $request->slug));

        if ($movieDetails !== null) {
            $init = Carbon::parse($movieDetails->release_date);
            $movieDetails->formated_release_date = $init->format('Y M d');
        }

        $data = view('movies.details', compact('movieDetails'))->render();
        return $this->successResponse('Data was successfully fetched.', $data);
    }
}
