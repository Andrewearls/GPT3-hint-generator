<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ConversationResource;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Return all the conversations for this user.
     *
     * @param Request
     * @return json
     */
    public function getAll(Request $request)
    {
        // dd($request->user()->conversations->first()->creator);
        return ConversationResource::collection($request->user()->conversations);
    }
}
