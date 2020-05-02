<?php 

namespace App\Services;

use App\Movie; 
use Carbon\Carbon;
use Illuminate\Support\Str;
use stdClass;

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

        $init = Carbon::parse($movie->release_date);
        $movie->formated_release_date = $init->format('Y M d');

        $data = new stdClass;
        
        $data->movie = $movie; 
        
        $comments = $movie->comments;
         
        if(gettype($comments) === 'object' && count($comments) > 0) {
            foreach ($comments as $comment) {        
                $init = Carbon::parse($comment->created_at); 
                $comment->formatted_created_at = $init->toRfc7231String();
                $comment->poster_name = $comment->user->name;
            }  
        }  
        $data->comments = $comments;
        return $data;
    }


    /**
     * Check if movie exists by id
     * @param string id
     * @return bool
     */
    public function movieExistsById(String $id): bool
    {
        return Movie::where('id', $id)->count() > 0;
    }


    /**
     * Returns the Id of a movie from DB using the ID
     * @param String $slug
     * @return String id
     */
    public function movieId(String $slug): string
    {
        return Movie::select('id')->where('slug', $slug)->first()['id'];
    }


    /**
     * Stores a new movie review
     * @param array 
     * @return bool
     */
    public function newMovie(Array $data): bool
    {
        $data['release_date'] = date('Y-m-d H:i:s');
        $data['slug'] = Str::slug($data['title'], '-');

        $extension = strtolower($data['photo']->extension());
        $newFileName =  md5($data['title'])  . '.' . $extension;
    
        if (!$data['photo']->storeAs('uploads/images', $newFileName, 'public')) {
            return false;
        }

        $data['photo'] = $newFileName;

        if (!Movie::create($data)) {
            return false;
        }
 
        return true;

    }
    
}