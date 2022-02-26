<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'Message Text' => $this->message_text,
            'Conversation' => $this->conversation->name,
            'Sender'       => $this->user->email,
            'Created'      => $this->created_at,
            'Updated'      => $this->updated_at,
        ];
    }
}
