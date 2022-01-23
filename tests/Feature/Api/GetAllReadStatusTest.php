<?php

it('gets all read status records', function () {
    $response = $this->get(route('api.read.status.get.all'));

    $response->assertStatus(200);
});
