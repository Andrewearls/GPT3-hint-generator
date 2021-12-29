<?php

use App\Models\User;
use App\Jobs\CreateAdaloUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Queue;

// test if user exists and token is not empty
test('user exists, return success', function () {

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
test('user exists, dont push job' , function () {

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
it('creates user', function () {
    
    Queue::fake();

    $user = User::factory()->make();

    $data = [
        'email' => $user->email,
        'device_name' => $user->name . ' mobile',
    ];

    $response = $this->postJson('/api/sanctum/token', $data);

    $user->refresh();

    $this->assertDatabaseHas('users', [
        'email' => $user->email,
    ]);

});

