<?php

use App\Jobs\Adalo\MessageUser;

it('can message user', function () {
    // $response = $this->get('/meassageuser');

    $conversation = 45; //this is a adalo tets user conversation

    MessageUser::dispatch('This is a message', $conversation);

    $response->assertStatus(200);
});
