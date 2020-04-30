<?php

namespace Tests;

 
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;

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

    public function generateUser(): User
    {       
        $this->userEmail = $this->faker->email;

        $this->user = new User(); 
        $this->user->email = $this->userEmail;
        $this->user->name = $this->faker->firstName() . '' . $this->faker->lastName;
        $this->user->password = $this->faker->password;
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
        $this->token = $this->user->createToken($this->userEmail)->accessToken; 
        return $this->token;
    } 

    /**
     * authentication headers
     * @return string
     */
    public function authHeaders(): array
    { 
        return [
            'Accept' => 'application/json', 
            'Authorization' => 'Bearer '.$this->token
        ];
    }


    
}
