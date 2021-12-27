<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('can connect', function () {
    $response = actingAs($this->user)->getJson('/api/user', []);
    $response->assertStatus(200);
});
