<?php

use App\Models\User;
use App\Jobs\CreateAdaloUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

beforeEach(function () {

    Queue::fake();

    $this->user = User::factory()->make();

    $this->data = [
        'email' => $this->user->email,
        'name' => $this->user->name,
        'device_name' => $this->user->name . ' mobile',
    ];

});

// test if user exists
test('user exists, return success', function () {

    $this->user->save();

    $token = $this->user->createToken($this->user->name . " mobile")->plainTextToken;

    $response = $this->postJson('/api/sanctum/token', $this->data);

    $response->assertStatus(200);
});

// test if user exists and token is empty
test('user exists, dont push job' , function () {

    $this->user->save();

    $response = $this->postJson('/api/sanctum/token', $this->data);

    $this->user->refresh();

    Queue::assertNotPushed(CreateAdaloUser::class);
});

// test if user exists and token is empty
test('user exists, no token created' , function () {

    $this->user->save();

    $response = $this->postJson('/api/sanctum/token', $this->data);

    $this->user->refresh();

    $this->assertTrue($this->user->tokens->isEmpty());
});

// test if user does not exist
it('creates user', function () {

    $response = $this->postJson('/api/sanctum/token', $this->data);

    $user = User::where('email', $this->user->email)->first();

    $this->assertModelExists($user);

});

// test if user exists and token is empty
it('creates token' , function () {

    $response = $this->postJson('/api/sanctum/token', $this->data);

    $user = User::where('email', $this->user->email)->first();

    $this->assertTrue($user->tokens->isNotEmpty());
});


// user doesn't exist job should push
it('pushes job' , function () {

    $response = $this->postJson('/api/sanctum/token', $this->data);

    Queue::assertNotPushed(CreateAdaloUser::class);
});