<?php

it('gets all conversations', function () {
    $response = $this->get(route('api.conversation.get.all'));

    $response->assertStatus(200);
});
