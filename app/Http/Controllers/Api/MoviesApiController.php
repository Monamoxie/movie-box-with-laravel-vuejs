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
     * 
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * 
     * @return Response
     */
    public function listMovies(Request $request, MovieService $movieService)
    {
        $movies = $movieService->allMovies();
        $data = view('movies.list', compact('movies'))->render();
        return $this->successResponse('Data was successfully fetched.', $data);
    }

    /**
     * Returns full details of a movie
     * 
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * 
     * @return Response
     */
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

    /**
     * Create and store a new movie
     * 
     * This controller will call the API service responsible for storing the movie
     * 
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * 
     * @return Response
     */
    public function storeMovie(Request $request, MovieService $movieService)
    { 
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://clients.primeairtime.com/api/auth');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
        curl_setopt(
            $ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'username' => 'roadrunnerdotng@gmail.com',
            'password' => 'Roadrunner44$'
        ]));
        $request = json_decode(curl_exec($ch));   
        curl_close($ch);          
        return $request; 
        
        $request->validate([
            'commennt' => ['required', 'string', 'min:1'],
            'slug' => ['required', 'string', 'exists:movies']
        ]);
    }
}
