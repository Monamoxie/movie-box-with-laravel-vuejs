<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as IlluminateStr;
use Tests\TestCase; 

class MoviesDetailsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setup();
        $this->generateUser();
    }

     /**
     * @group moviedetails
     * @test
     */
    public function fail_if_request_not_get()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('POST', '/api/v1/movies/' . $this->faker->city);
        $response->assertStatus(405); 
    }

   
    /**
     * @group moviedetails
     * @test 
     */
    public function fail_if_required_id_not_exist()
    {
        // First insert
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('GET', '/api/v1/movies/' . $this->faker->city );
          
        $response->assertStatus(500);  
    }
  
    /**
     * @group moviedetails
     * @test 
     */
    public function movie_details_should_pass_if_request_is_okay()
    {
        $this->newMovie();

        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('GET', '/api/v1/movies/' . $this->newMovieId);
            
        $response->assertStatus(200);  
    }

}
