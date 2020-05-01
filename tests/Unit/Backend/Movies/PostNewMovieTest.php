<?php

namespace Tests\Unit;
 
use Illuminate\Http\UploadedFile; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str as IlluminateStr;
use Tests\TestCase; 

class PostNewMovieTest extends TestCase
{
    
    protected function setUp(): void
    {
        parent::setup();
        $this->generateUser();
    }

     
    /**
     * @group moviepost
     * @test 
     */
    public function fail_if_user_not_authenticated()
    {
       
        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        
        $slug = IlluminateStr::slug($title, '-');
        
        // First insert
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/api/v1/movie/new', [
            'title' => $title,
            'description' => $this->faker->text(200),
            'release_date' => $this->faker->dateTime(),
            'rating' => rand(2, 5),
            'ticket_price' => rand(2300, 4000),
            'country' => $this->faker->country,
            'genre' => $this->faker->randomElement(['action', 'romance', 'comedy', 'classical']),
            'photo' => $photo, 
            'slug' => $slug
        ]);
         
        $response->assertStatus(401);  
    }

    /**
     * @group moviepost
     * @test 
     */
    public function fail_if_required_param_not_passed()
    {
    
        Storage::fake(); 
        $photo = UploadedFile::fake()->image('ao.png');     
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        $slug = IlluminateStr::slug($title, '-');
        // First insert
        $response = $this->withHeaders($this->authHeaders())
        ->json('POST', '/api/v1/movie/new', [
            'title' => $title,
            'description' => $this->faker->text(200),
            'release_date' => $this->faker->dateTime(),
            'rating' => '', // This is required but I wont pass it
            'ticket_price' => rand(2300, 4000),
            'country' => $this->faker->country,
            'genre' => $this->faker->randomElement(['action', 'romance', 'comedy', 'classical']),
            'photo' => $photo,
        ]);
          
        $response->assertStatus(422);  
    }
  
    /**
     * @group moviepost
     * @test 
     */
    public function pass_if_request_is_okay()
    {
        
        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        $ticketPrice = rand(2300, 4000); 
        
        // First insert
        $response = $this->withHeaders($this->authHeaders())
        ->json('POST', '/api/v1/movie/new', [
            'title' => $title,
            'description' => $this->faker->text(200),
            'release_date' => $this->faker->dateTime(),
            'rating' => rand(2, 5),
            'ticket_price' => $ticketPrice,
            'country' => $this->faker->country,
            'genre' => $this->faker->randomElement(['action', 'romance', 'comedy', 'classical']),
            'photo' => $photo
        ]);
         
     
         // Ensure DB contains the recetly added slug
        $this->assertDatabaseHas('movies', [
            'title' => $title,
            'ticket_price' => $ticketPrice
        ]);

        Storage::disk('public')->assertExists('uploads/images/'. md5($title) . '.png');
      
        //attempt removing rhe file
        Storage::disk('public')->delete('uploads/images/'. md5($title) . '.png');

        //check file deletetion
        Storage::disk('public')->assertMissing('uploads/images/'. md5($title).'.png'); 

         
    }

}
