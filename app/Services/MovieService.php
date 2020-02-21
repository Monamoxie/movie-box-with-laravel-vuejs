<?php 

namespace App\Services;

use App\Movie;

class MovieService
{

    /**
     * Returns all the movies in the table in descending order
     * @param null
     * @return object of App\Movie
     */
    public function allMovies(): object
    {
        return Movie::orderBy('release_date')->get();
    }
    
}