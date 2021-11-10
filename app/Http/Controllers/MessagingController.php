<?php

namespace App\Http\Controllers;

use App\Events\MessageUser;
use Illuminate\Http\Request;

class MessagingController extends Controller
{
    /**
     * Receive messege from user.
     * Sanatize message.
     * Trigger MessageGPT event.
     * Return success.  
     *
     * @param Request
     * @return success
     */
    public function messageGPT(Request $request)
    {
        // Sanatize
        // Trigger Event
        // MessageUser::dispatch($request->message);
        broadcast(new MessageUser($request->message))->toOthers();
        return response(200);
    }
}
