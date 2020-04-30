<?php

namespace Tests\Unit;
 
use Tests\TestCase; 

class ListMoviesTest extends TestCase
{
    
    protected function setUp(): void
    {
        parent::setup();
        $this->generateUser();
    }

     /**
     * @group movieslist
     * @test
     */
    public function fail_if_request_not_get()
    {
        $response = $this->withHeaders($this->authHeaders())
            ->json('POST', '/api/v1/movies');
        $response->assertStatus(405); 
    }
 
  
    /**
     * @group movieslist
     * @test 
     */
    public function movies_list_should_pass_if_request_is_okay()
    {
        $this->newMovie();

        $response = $this->withHeaders($this->authHeaders())
        ->json('GET', '/api/v1/movies');       
        $response->assertStatus(200);  
    }

}


 
