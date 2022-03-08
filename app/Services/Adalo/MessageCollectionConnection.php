<?php

namespace App\Services\Adalo;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class MessageCollectionConnection extends Connection
{

    /**
     * Create a new service instance.
     *
     * @return json
     */
    public function __construct()
    {
        parent::__construct(env('ADALO_MESSAGE_COLLECTION_ID'));
    }

    /**
     * Create new message.
     *
     * @param Adalo User Id
     * @param Collection Id
     * @param message
     */
    public function persist($conversation, $message)
    {
        return Http::accept('application/json')->withToken($this->bearerToken)->post($this->url, [
            'Message Text' => $message,
            'Conversation' => $conversation,
            'Sender'       => env('ADALO_PIONEER'),
        ]);
    }

}
