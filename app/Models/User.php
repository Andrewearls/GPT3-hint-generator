<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Create a conversation.
     *
     * @param User Model
     * @return Model Conversation
     */
    public function conversation()
    {
        return $this->hasMany(Conversation::class, 'user_id');
    }

    /**
     * Get the conversations that the user belongs to.
     *
     * @return Collection Conversation Class
     */
    public function conversations()
    {
        return $this->belongsToMany(Conversation::class, 'conversation_members')->withPivot('read_status');
    }

    /**
     * Get the messages that belong to the user.
     *
     * @return view
     */
    public function message()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the messages that belong to the user through conversations.
     *
     * @return Collection Message Model
     */
    public function messages()
    {
        //select the messsages
        //in the conversations
        //that this user is a member of
        return Message::whereHas('conversation.members', function (Builder $query) {
            $query->where('user_id', $this->id);
        })->get();
    }

    /**
     * Get the readstatus that belong to the user.
     *
     * @return Collection ReadStatus Model
     */
    public function readStatus()
    {
        return $this->hasMany(ReadStatus::class);
    }
}
