<?php

use App\Services\Adalo\UserCollectionConnection as Client;

test('it gets all users', function () {
    $users = new Client();

    $response = $users->getAll();

    // dd($response->json());

    $response->assertStatus(200);
});
