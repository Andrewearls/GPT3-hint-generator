<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdaloUserController extends Controller
{
    /**
     * Update the Adalo user Id.
     *
     * @param Request
     * @return view
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $user->adalo_user_id = $request->user_id;

        $user->save();

        $conversation = $user->conversation()->create([
            'name'                  => $request->conversation_name,
            'adalo_conversation_id' => $request->conversation_id,
        ]);

        return 'success';
    }
}
