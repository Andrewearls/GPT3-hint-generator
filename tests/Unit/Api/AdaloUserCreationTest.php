<?php

use App\Models\User;
use App\Jobs\CreateAdaloUser;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

// can dispatch
it('can dispatch', function () {

    Queue::fake();

    $user = User::factory()->make();

    CreateAdaloUser::dispatch($user->email);

    Queue::assertPushed(CreateAdaloUser::class);
});

// create new user
it('creates new user', function () {

    $user = User::factory()->make([
        'email' => 'andrew.e.earls@gmail.com',
    ]);

    CreateAdaloUser::dispatch($user->email);

    $this->assertDatabaseHas('users', [
        'email' => $user->email,
    ]);

});

// set sanctum token
// sends token to adalo 

// adalo has no user
// test('adalo does ')