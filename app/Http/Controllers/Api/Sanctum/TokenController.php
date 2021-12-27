<?php

namespace App\Http\Controllers\Api\Sanctum;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    /**
     * create token for user.
     *
     * @param Request
     * @return json plaintext token
     */
    public function create(Request $request)
    {
        // this should be moved to a validation request
        $request->validate([
            'email' => 'required|email',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        /** 
         * This should probably be middleware
         * 
         * if user is in database
         * and if sanctum token valid
         */
        if ($user && $user->tokens->isNotEmpty()) { 
            // user has valid token do nothing
            return "token not created";
        }
        
        // Sync user info
        // Generate new token

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
