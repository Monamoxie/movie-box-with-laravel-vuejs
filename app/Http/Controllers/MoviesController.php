<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
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

    /**
     * Store a new movie
     * 
     * @param Illuminate\Http\Request, App\Services\MovieService;
     * 
     * @return Response
     */

    public function storeMovieComment(Request $request, CommentService $commentService)
    { 
        $request->validate([
            'comment' => ['required', 'string', 'min:1'],
            'slug' => ['required', 'string', 'exists:movies']
        ]);

        $newMovie = $commentService->newMovieComment($request->slug, $request->comment);
        if ($newMovie === false) {
            return redirect()->back()->withInput()->with('danger', 'An error occured. Please try again');
        }
        else {
            return redirect("/movies/".$request->slug)->with('success', 'Comment has been successfully posted');
        }
    }

    /**
     * This will just return a skeleton. The actual content will be called up by Axios asynchronously
     */
    public function createMovie(Request $request)
    {
        return view('movies.new');
    }

    public function storeMovie(Request $request, MovieService $movieService)
    {
        
        $request->validate([
            'title' => ['required', 'string', 'unique:movies'],
            'country' => ['required', 'string'],
            'genre' => ['required', 'string'],
            'ticket_price' => ['required', 'numeric'],
            'rating' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'photo' => ['required', 'file', 'image', 'mimes:jpeg,jpg,png', 'max:5120']
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
