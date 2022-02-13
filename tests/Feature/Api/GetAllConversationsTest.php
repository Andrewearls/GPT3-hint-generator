<?php

it('gets all conversations', function () {
    $response = $this->get(route('api.conversation.get.all'));
    // dd($response->decodeResponseJson());
    $response->assertStatus(200);
});
