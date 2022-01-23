<?php

it('gets all messages', function () {

    $response = $this->get(route('api.message.get.all'));

    $response->assertStatus(200);
});
