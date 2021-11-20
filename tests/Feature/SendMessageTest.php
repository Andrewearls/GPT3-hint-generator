<?php

// it('can block invalad requests', function ($message) {
//     $response = $this->postJson(route('message.GPT'), [$message]);
//     $response->assertStatus(422);
// })->with('messages');

// user sends a message publicly
it('can send user messages', function ($message) {
    $response = $this->postJson(route('message.GPT'), ['message' => $message]);
    $response->assertStatus(200);
})->with('messages');

// message is received, sanitized, validated
it('can process user messages', function () {
    $this->assertTrue(false);
});

// message is sent to gpt with instructions
// gpt response is requested
// gpt message is santized, validated
// gpt message is re requesed if needed
// bpt message is broadcasted publicly