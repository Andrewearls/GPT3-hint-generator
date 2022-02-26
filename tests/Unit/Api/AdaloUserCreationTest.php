<?php

use App\Models\User;
use App\Jobs\CreateAdaloUser;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;

// can dispatch
it('can dispatch', function () {

    Queue::fake();

    $user = User::factory()->make();

    CreateAdaloUser::dispatch($user->email, $user->name);

    Queue::assertPushed(CreateAdaloUser::class);
});

// create new user
it('creates new user', function () {

    $user = User::factory()->make([
        'email' => 'andrew.e.earls@gmail.com',
    ]);

    CreateAdaloUser::dispatch($user->email, $user->name);

    $this->assertDatabaseHas('users', [
        'email' => $user->email,
    ]);

});

// set sanctum token
it('sets the sanctum token', function () {

    $user = User::factory()->make([
        'email' => 'andrew.e.earls@gmail.com',
    ]);

    CreateAdaloUser::dispatch($user->email, $user->name);

    $user->refresh();

    dd($user->tokens);
    $this->assertTrue($user->tokens->isEmpty());
});

// sends token to adalo 

// adalo has no user
// test('adalo does ')