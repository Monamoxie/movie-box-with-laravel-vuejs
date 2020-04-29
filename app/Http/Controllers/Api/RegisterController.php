<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller; 
use App\Services\UserService; 
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    /** Register user 
     * @param Illuminate\Http\Request
     * @param App\Services\UserService; 
     * @return Response
    */
    public function register(Request $request, UserService $userService) 
    {    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
        ]);
        
        if($userService->newUser($request->all())) {
            return $this->successResponse('Data was successfully fetched');
        }
        return $this->errorResponse('User not created');
    }

}
