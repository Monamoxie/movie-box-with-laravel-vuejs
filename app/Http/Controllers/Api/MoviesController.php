<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CommentService;
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

            return $movieDetails !== null ?
                $this->successResponse('Data was successfully fetched.', $movieDetails) : 
                $this->errorResponse('No record found'); 
    }

    /**
     * Post comment on a movie review
     * @param Illuminate\Http\Request, App\Services\CommenService
     * @return Response
     */
    public function newComment(Request $request, CommentService $commentService, MovieService $movieService)
    {   
      
        $request->validate([
            'comment' => ['required', 'string', 'min:1']
        ]);

        $movieId = preg_replace('#[^a-z0-9-]#i', '', $request->id);
        if(!$movieService->movieExistsById($movieId)) {
            return  $this->errorResponse('This movie does not exist', 'An error occured');
        }
        $comment = $commentService->newComment($movieId, $request->comment);
        if ($comment === null) {
            return $this->errorResponse('Comment was not created', 'An error occured');
        }
        else {
            return $this->successResponse('Comment was successfully created', $comment);
        } 
    }

    public function newMovie(Request $request, MovieService $movieService)
    {
        dd(public_path());
        $request->validate([
            'title' => ['required', 'string'],
            'country' => ['required', 'string'],
            'genre' => ['required', 'string'],
            'ticket_price' => ['required', 'numeric'],
            'rating' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);

        $newMovie = $movieService->newMovie($request->all());
        if ($newMovie === false) {
            return redirect()->back()->withInput()->with('danger', 'An error occured. Please try again');
        }
        else {
            return redirect("/movies/create/new")->with('success', 'Movie has been successfully posted');
        }
    }



    
}
