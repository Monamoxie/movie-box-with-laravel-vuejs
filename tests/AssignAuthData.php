<?php

namespace Tests; 
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait AssignAuthData
{
    /**
     * A newly generated user
     * @return \App\Models\User
     */
    public $user;
    
    /**
     * A newly generated access token
     * @return String
     */    
    public $accessToken;


    /**
     * A pregenerated email address for this user
     * @return string
     */
    public $userEmail;

    /**
     * A pregenerated password for this user\
     * @return string
     */
    public $userPassword;

    public function generateUser(): User
    {    
        \Artisan::call('passport:install');

        $this->userEmail = $this->faker->email;
        $this->userPassword = $this->faker->password;

        $this->user = new User(); 
        $this->user->email = $this->userEmail;
        $this->user->name = $this->faker->firstName() . '' . $this->faker->lastName;
        $this->user->password = $this->userPassword;
        $this->user->save();
        $this->createToken();  
        return $this->user;
    }

    /**
     * Create access token
     * @return string
     */
    protected function createToken(): string
    { 
        $this->accessToken = $this->user->createToken($this->userEmail)->accessToken; 
        return $this->accessToken;
    } 

    /**
     * authentication headers
     * @return string
     */
    public function authHeaders(): array
    { 
        return [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer '.$this->accessToken
        ];
    }

    /**
     * create a new movie
     * @return bool
     */
    public function newMovie(): bool
    {
        Storage::fake(); 

        $photo = UploadedFile::fake()->image('ao.png');
         
        $title = ucfirst($this->faker->words[0]) . ' ' . ucfirst($this->faker->words[0]);
        $ticketPrice = rand(2300, 4000); 
        
        $this->withHeaders($this->authHeaders())
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
         
        return true;
    
    }


    
}
