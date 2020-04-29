<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Log user out of the app
     * 
     */
    public function logout() 
    {
        auth()->user()->tokens->each(function($token) {
            $token->delete();
        });
        return $this->successResponse('Logged out successfully');
    }
}
