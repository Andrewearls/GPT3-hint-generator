<?php

namespace App\Http\Controllers;

use App\Events\MessageUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; 
use App\Http\Requests\UserMessageRequest;
use App\Jobs\MessageGPT as OutgoingMessage;

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
    public function messageGPT(UserMessageRequest $request)
    {
        $validated = $request->safe()->collect();
        $message = $validated['message'];
        // dd($message);
        // Sanatize

        // Trigger Event
        OutgoingMessage::dispatch($message);
        // broadcast(new MessageUser($request->message))->toOthers();
        // broadcast(new MessageUser($a))->toOthers();
        return response(200);
    }
}
