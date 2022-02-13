<?php

it('gets all read status records', function () {
    $response = $this->get(route('api.read.status.get.all'));
    // dd($response->decodeResponseJson());
    $response->assertStatus(200);
});
