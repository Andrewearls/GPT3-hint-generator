<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
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
            'Name'                   => $this->name,
            'Creator'                => $this->creator->email,
            'Members'                => $this->members->map->only(['email'])->flatten(),
            'Last Message Sent Date' => $this->messages->last()->created_at,
            'Messages'               => $this->messages->map->only(['message_text'])->flatten(),
            'Read Status'            => ['Read'],
            'Created'                => $this->created_at,
            'Updated'                => $this->updated_at,
        ];
    }
}
