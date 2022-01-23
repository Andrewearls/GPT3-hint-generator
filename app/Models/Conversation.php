<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get the members of this conversation.
     *
     * @return Collection User Class
     */
    public function members()
    {
        return $this->belongsToMany(
            User::class, 
            'conversation_members'
        )->withPivot('read_status');
    }

    /**
     * Get the creator of the conversation.
     *
     * @return User Class
     */
    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the messages that belong to this conversation.
     *
     * @return Collection Message Model
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
}
