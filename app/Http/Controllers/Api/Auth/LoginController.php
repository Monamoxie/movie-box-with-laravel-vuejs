<?php
 
namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller; 
use App\Services\UserService; 
use Illuminate\Http\Request;

class LoginController extends Controller
{ 
    /** Login user 
     * @param Illuminate\Http\Request
     * @param App\Services\UserService
     * @return Response
    */
    public function login(Request $request, UserService $userService)
    {
dd('ddd');
        $request->validate([ 
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);
        
        
        $user = $userService->authUser($request->all());

        if ($user === null) { 
            return $this->errorResponse('Invalid Credentials. Please enter a valid username and password', 'An error occured',  402);
        }
        else {  
            $user = User::where('email', $request->email)->first();
            $user->token = $user->createToken('user')->accessToken;
            return $this->successResponse('Successfully authenticated', $user);    
        } 
    }

}
