<?php 

namespace App\Services;
 
use App\Comment;
use App\Services\MovieService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CommentService
{
 

    /**
     * Create a new comment by for a movie
     * @param string movieId 
     * @param string comment
     * @return int 
    */
    public function newComment(String $movieId, String $comment): ?object
    { 
        if (!$comment = Comment::create([
            'comment' => $comment,
            'movie_id' => $movieId,
            'poster' => Auth::id(),
        ])) {
            return null;
        }
        $init = Carbon::parse($comment->created_at); 
        $comment->formatted_created_at = $init->toRfc7231String();
        $comment->poster_name = $comment->user->name;
        return $comment;
    }

    
    
}