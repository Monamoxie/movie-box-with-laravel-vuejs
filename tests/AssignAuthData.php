<?php

namespace Tests; 
use App\User; 

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


    
}
