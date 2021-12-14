<?php

use App\Models\User;
use App\Events\MessageUser;

beforeEach(function () {
    $this->user = User::factory()->create();
});

// create user
it('can log in', function () {
    $response = actingAs($this->user)->get(route('messages'));
    $response->assertSuccessful();
});

// user sends message
it('can send message', function ($message) {
    $response = actingAs($this->user)->postJson(route('message.GPT'), ['message' => $message]);
    $response->assertStatus(200);
})->with('messages');

// user receives message
it('can receive message', function ($message) {
    // visit user message page
    $response = actingAs($this->user)->get(route('messages'));
    // trigger message user event
    MessageUser::dispatch($message, $this->user);

    // MessageUser::assertDistpatched();
    // view message on user page
    // $response->assertSee($message);
})->with('messages')
    ->expectsEvents(MessageUser::class);

// messages are stored in database