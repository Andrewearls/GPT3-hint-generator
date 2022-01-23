<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadStatus extends Model
{
    use HasFactory;

    /**
      * The table associated with the model.
      *
      * @var string
      */
     protected $table = 'read_status';

     /**
      * Get the conversation that this status belongs to.
      *
      * @return Conversation Class
      */
     public function conversation()
     {
         return $this->belongsTo(Conversation::class);
     }
}
