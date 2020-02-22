<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations; 
use Tests\TestCase; 

class MoviesListTest extends TestCase
{
    use DatabaseMigrations;
     /**
     * @group movieslist
     * @test
     */
    public function movies_list_should_fail_if_request_not_post()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('GET', '/api/v1/movies/list');
        $response->assertStatus(405); 
    }

  
    /**
     * @group movieslist
     * @test 
     */
    public function movies_list_should_pass_if_request_is_okay()
    {
        
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/api/v1/movies/list');
            
        $response->assertStatus(200);  
    }

}
