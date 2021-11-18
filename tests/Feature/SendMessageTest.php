<?php

it('can send message', function ($message) {
    $response = $this->postJson(route('message.GPT'), [$message]);
    $response->assertStatus(200);
})->with('messages');