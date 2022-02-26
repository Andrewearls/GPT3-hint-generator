<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;

class ConversationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $conversation = $users->first()->conversation()->create([
            'name' => $users->first()->name . ' / ' . $users->last()->name,
        ]);

        $conversation->members()->attach($users->first());
        $conversation->members()->attach($users->last());

        $conversation->messages()->save($users->last()->message()->save(Message::factory()->make()));

    }
}
