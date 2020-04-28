<?php 

namespace App\Services;

use App\User; 
use Illuminate\Support\Facades\Hash;  

class UserService
{

    /**
     * Returns all the movies in the table in descending order
     * @param array
     * @return bool
     */
    public function newUser(Array $payload): bool
    {
        if(User::create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password'])
        ])) {
            return true;
        }
        return false;
    }
  
    
}