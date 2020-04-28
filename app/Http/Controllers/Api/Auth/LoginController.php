<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{ 
    /** Login user 
     * @param Illuminate\Http\Request;
     * @return Response
    */
    public function login(Request $request)
    {
        $request->validate([ 
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

         
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password], 1)) {
            return response()->json('Invalid Credentials. Please enter a valid username and password', 402);
        }
        else {  
            $user = User::where('email', $request->email)->first();
            $user->token = $user->createToken('user')->accessToken;
            return response()->json($user, 200);    
        } 
    }

}
