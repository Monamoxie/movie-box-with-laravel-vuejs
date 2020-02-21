<?php 

namespace App\Services;
 
use App\Comment;
use App\Services\MovieService;
use Illuminate\Support\Facades\Auth;

class CommentService
{
 

    /**
     * Store a new movie Comment
     * 
     * @param String $slug, String $comment
     * 
     * @return bool 
     */
    public function newMovieComment(String $slug, String $comment): bool
    {
        $movieService = new MovieService();
        $movieID = $movieService->movieId($slug);
        if (!Comment::create([
            'comment' => $comment,
            'movie_id' => $movieID,
            'poster' => Auth::id(),
        ])) {
            return false;
        }
        return true;
    }

    
    
}