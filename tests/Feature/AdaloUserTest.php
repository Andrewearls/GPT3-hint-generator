<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

beforeEach(function () {
    $this->user = User::factory()->create();
    Sanctum::actingAs(
        $this->user,
        ['user-update']
    );

    $this->response = actingAs($this->user)->post('/api/user/update-adalo-id', [
        'email'             => $this->user->email,
        'user_id'           => 1,
        'conversation_name' => 'testing name',
        'conversation_id'   => 1,
    ]);
});

it('can send post request', function () {
    $this->response->assertStatus(200);
});

it('can update adalo user id', function () {

    $this->user->refresh();

    $this->assertEquals($this->user->adalo_user_id, "1");
});

it('can update adalo conversation id', function () {

    $this->user->refresh();
    $this->assertEquals($this->user->conversation()->first()->adalo_conversation_id, "1");
});
