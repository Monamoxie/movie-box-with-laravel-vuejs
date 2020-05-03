<?php

namespace Tests\Unit;

use App\User; 
use Tests\TestCase; 

class MoviesAddCommentTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setup();
        $this->generateUser();
        $this->newMovie();
    }

     /**
     * @group movie_add_comment
     * @test
     */
    public function fail_if_request_not_put()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('GET', '/api/v1/movie/' . $this->newMovieId . '/comment/new');
        $response->assertStatus(405); 
    }

    
    /**
     * @group movie_add_comment
     * 
     */
    public function fail_if_user_not_authenticated()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('PUT', '/api/v1/movie/' . $this->newMovieId . '/comment/new', [
            'comment' => $this->faker->word
        ]);
        
        $response->assertStatus(401);  
    }

    /**
     * @group movie_add_comment
     * @test
     */
    public function fail_if_required_param_not_passed()
    {
        $response = $this->withHeaders($this->authHeaders())
        ->json('PUT', '/api/v1/movie/' . $this->newMovieId . '/comment/new', [
            'comment' => '',
        ]); 
        $response->assertStatus(422);  
    }
  
    /**
     * @group movie_add_comment
     * @test
     */
    public function pass_if_request_is_okay()
    {
         
        $comment = $this->faker->text();
        
        $response = $this->withHeaders($this->authHeaders())
        ->json('PUT', '/api/v1/movie/' . $this->newMovieId . '/comment/new', [
            'comment' => $comment
        ]);

        $response->assertStatus(200);  
         
        $this->assertDatabaseHas('comments', [
            'comment' => $comment,
            'movie_id' => $this->newMovieId
        ]);
         
    }

}
