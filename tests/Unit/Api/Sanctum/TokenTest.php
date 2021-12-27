<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;


it('creates a token', function () {

    $password = 'nopasswordneeded';

    $user = User::factory()->create([
        'password' => Hash::make($password),
    ]);

    $data = [
        'email' => $user->email,
        'password' => $password,
        'device_name' => $user->name . ' mobile',
    ];

    $response = $this->postJson('/api/sanctum/token', $data);

    $response->assertSuccessful();
});
