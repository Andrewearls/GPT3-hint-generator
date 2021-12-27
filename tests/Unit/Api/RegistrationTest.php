<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->make();
    $this->data = [
        'name' => $this->user->name,
        'email' => $this->user->email,
        'password' => 'fakepassword',
        'password_confirmation' => 'fakepassword',
    ];
    $this->request = $this->postJson('/api/registration', $this->data);
});

it('creates a new user', function () {
    dd($this->request);
    $this->request->assertStatus(201);
});

test('user is in database', function () {
    $this->assertDatabaseHas('users', [
        'email' => $this->user->email,
    ]);
});