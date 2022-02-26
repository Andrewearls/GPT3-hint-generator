<?php

namespace App\Http\Controllers\Api\Sanctum;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Jobs\CreateAdaloUser;

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
            'name' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::firstOrNew(
            ['email' => $request->email],
            [
                'password' => Hash::make(Str::random(10)),
                'name' => $request->name,
            ],
        );

        /** 
         * This should probably be middleware
         * 
         * if user is in database
         */
        if ($user->exists) { 
            // user exists do nothing
            return response()->json([
                'message' => 'token not created',
            ]);
        }

        // Persist user to database
        $user->save();
        $user->refresh();

        // Create new Adalo User Relationship
        // CreateAdaloUser::dispatch($user);

        // set sanctum token
        $token = $user->createToken($user->name.' Adalo Token')->plainTextToken;

        return response()->json(['token' => $token]);
    }
}
