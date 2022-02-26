<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadStatusResource extends JsonResource
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
            'Name'         => "Read", // This should be changed to reflect the value on the pivot table
            'Conversation' => $this->name,
            'User'         => $request->user()->email,
            'Created'      => $this->created_at,
            'Updated'      => $this->updated_at,
        ];
    }
}
