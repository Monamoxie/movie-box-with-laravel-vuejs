<?php 

namespace App\Services;

use App\Movie;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Str; 

class MovieService
{

    /**
     * Returns all the movies in the table in descending order
     * @param null
     * @return object of App\Movie
     */
    public function allMovies(): object
    {
        return Movie::orderBy('release_date')->paginate(6);
    }

    /**
     * Returns the full details of a particular movie
     * @param String $slug
     * @return object of App\Movie
     */
    public function movieDetails(String $id): ?object
    {
        $movie = Movie::where('id', $id)->first();
        if ($movie === null) {
            return null;
        }
        $movie->comments = $movie->comments;
        if(gettype($movie->comments) === 'object' && count($movie->comments) > 0) {
            foreach ($movie->comments as $key => $comment) {
                $date = Carbon::createFromFormat('Y-m-d H:i:s', $comment->created_at);
                $movie->comments->created_at = $date->toRfc7231String();
            }  
        }  
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