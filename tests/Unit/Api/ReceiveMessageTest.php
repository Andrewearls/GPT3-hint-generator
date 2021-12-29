<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;

uses(RefreshDatabase::class);

beforeEach(function () {
    Queue::fake();
    
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );

    $this->message = ['message' => 'this is a message'];
});

it('can receive message', function () {

    $response = $this->postJson(route('api.message.send'), $this->message);

    $response->assertSuccessful();
    
});

// message recieved

// validate sanitize
// dispatch job