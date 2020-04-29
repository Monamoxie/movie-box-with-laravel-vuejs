<?php 

namespace App\Services;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;  

class UserService
{

    /**
     * Create new user
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

    /**
     * Auth user in to account
     * @param array
     * @return bool
     */    
    public function login(Array $payload): ?object
    {
        if (! 
            Auth::attempt([
                'email' => $payload['email'], 
                'password' => $payload['password']
            ]) ) {
            return null;
        } 
        $user = User::where('email', $payload['email'])->first();
        $user->access_token = $user->createToken($payload['email'])->accessToken;
        return $user;     
    }
    
}