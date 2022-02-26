<?php

it('gets all messages', function () {

    $response = $this->get(route('api.message.get.all'));

    dd($response->decodeResponseJson());

    $response->assertSee('Sender');
});
