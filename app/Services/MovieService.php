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


0216dcef025fd3e5fa6fcede2f618e1b.jpg  b041a6e3338664fda114064fc8bc6119.jpg
06e48ad404226ac94e2a5538d8062426.jpg  banner2.jpg
1.jpg                                 banner22.jpg
2cb1e9b8b26c1b730e74b460ac36e5e3.jpg  circle_ci_test.png
3c514570e62adde029bae60ab1ef9d1f.png  lady-happy-removebg-preview.png
50b025396aca31b6c0462a6174656f17.jpg  logo.png
7da0438f03388c05e592a83ca55e4598.jpg  logo2.png
9aaf1cc7a08bd6830b132fc58d5260a2.jpg  look2.png
a81f1e99f1272eb3591db73e7f54cd5d.jpg


a81f1e99f1272eb3591db73e7f54cd5d.jpg