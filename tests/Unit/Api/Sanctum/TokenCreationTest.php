<?php

use App\Models\User;
use App\Jobs\CreateAdaloUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;

// test if user exists and token is not empty
test('user exists and token not empty', function () {

    Queue::fake();

    $user = User::factory()->create();
    $token = $user->createToken($user->name . " mobile")->plainTextToken;

    $data = [
        'email' => $user->email,
        'device_name' => $user->name . ' mobile',
    ];

    $response = $this->postJson('/api/sanctum/token', $data);

    $response->assertStatus(200);
});

// test if user exists and token is empty
test('user exists and token is empty', function () {

    Queue::fake();

    $user = User::factory()->create();

    $data = [
        'email' => $user->email,
        'device_name' => $user->name . ' mobile',
    ];

    $response = $this->postJson('/api/sanctum/token', $data);

    $user->refresh();

    Queue::assertNotPushed(CreateAdaloUser::class);
});

// test if user does not exist
test('user does not exists', function () {
    
    Queue::fake();

    $user = User::factory()->make();

    $data = [
        'email' => $user->email,
        'device_name' => $user->name . ' mobile',
    ];

    $response = $this->postJson('/api/sanctum/token', $data);

    $user->refresh();

    Queue::assertPushed(CreateAdaloUser::class);
});

