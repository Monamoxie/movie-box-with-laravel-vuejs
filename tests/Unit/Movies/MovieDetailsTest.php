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
    use DatabaseMigrations;

     /**
     * @group moviedetails
     * 
     * @test
     */
    public function movie_details_should_fail_if_request_not_post()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
            ->json('GET', '/api/v1/movies/details');
        $response->assertStatus(405); 
    }

    /**
     * @group moviedetails
     * 
     * @test 
     */
    public function movie_details_should_fail_if_user_not_authenticated()
    {
       
        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        
        $slug = IlluminateStr::slug($title, '-');
        
        // First insert
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/movies/store', [
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
     * @group moviedetails
     * 
     * @test 
     */
    public function movie_details_should_fail_if_required_param_not_passed()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user);

        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        
        $slug = IlluminateStr::slug($title, '-');
        
        // First insert
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/movies/store', [
            'title' => $title,
            'description' => $this->faker->text(200),
            'release_date' => $this->faker->dateTime(),
            'rating' => '', // This is required but I wont pass it
            'ticket_price' => rand(2300, 4000),
            'country' => $this->faker->country,
            'genre' => $this->faker->randomElement(['action', 'romance', 'comedy', 'classical']),
            'photo' => $photo, 
            'slug' => $slug
        ]);
          
        $response->assertStatus(422);  
    }
  
    /**
     * @group moviedetails
     * 
     * @test 
     */
    public function movie_details_should_pass_if_request_is_okay()
    {
        
        $user = factory(User::class)->create();

        $this->actingAs($user);

        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        
        $slug = IlluminateStr::slug($title, '-');
        
        // First insert
        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/movies/store', [
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
         
        // Ensure redirection was successsful
        $response->assertRedirect('/movies/create/new');

         // Ensure DB contains the recetly added slug
        $this->assertDatabaseHas('movies', [
            'slug' => $slug
        ]);

        Storage::disk('public_dir')->assertExists('uploads/'. md5($title) . '.png');
      
        //attempt removing rhe file
        Storage::disk('public_dir')->delete('uploads/'. md5($title) . '.png');

        //check file deletetion
        Storage::disk('public_dir')->assertMissing('uploads/'. md5($title).'.png'); 

        $response = $this->withHeaders([
            'Accept' => 'application/json'])
        ->json('POST', '/api/v1/movies/details', [
            'slug' => $slug
        ]);
            
        $response->assertStatus(200);  
    }

}
