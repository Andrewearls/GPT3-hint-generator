<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReadStatusResource;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Get all the conversation read status for this user.
     *
     * @param Request
     * @return view
     */
    public function getAll(Request $request)
    {
        return ReadStatusResource::collection($request->user()->conversations);
    }
}
