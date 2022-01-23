<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the message.
     *
     * @return User Class
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the conversation that owns the message.
     *
     * @return Conversation Class
     */
    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
