<?php 

namespace App\Services;

use App\Movie;
use App\Comment;
use Illuminate\Support\Str;
use stdClass;

class MovieService
{

    /**
     * Returns all the movies in the table in descending order
     * 
     * @param null
     * 
     * @return object of App\Movie
     */
    public function allMovies(): object
    {
        return Movie::orderBy('release_date')->get();
    }

    /**
     * Returns the full details of a particular movie
     * 
     * @param String $slug
     * 
     * @return object of App\Movie
     */
    public function movieDetails(String $slug): object
    {
        $movie = Movie::where('slug', $slug)->first();
        if ($movie === null) {
            $movie = new stdClass;
        }
        $movie->comments = $movie->comments;
        return $movie;
    }

   

    /**
     * Returns the Id of a movie from DB using the ID
     * 
     * @param String $slug
     * 
     * @return String id
     */
    public function movieId(String $slug): string
    {
        return Movie::select('id')->where('slug', $slug)->first()['id'];
    }

    /**
     * Stores a new movie into the DB
     * 
     * @param array 
     * 
     * @return bool
     */
    public function newMovie(Array $data): bool
    {
        $data['release_date'] = date('Y-m-d H:i:s');
        $data['slug'] = Str::slug($data['title'], '-');

        $extension = strtolower($data['photo']->extension());
        $newFileName =  md5($data['title'])  . '.' . $extension;
    
        if (!$data['photo']->storeAs('images', $newFileName, 'public_dir')) {
            return false;
        }

        $data['photo'] = $newFileName;

        if (!Movie::create($data)) {
            return false;
        }
 
        return true;

    }
    
}