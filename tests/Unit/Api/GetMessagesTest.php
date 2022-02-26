<?php


// before each
    //create a user
    //create a message
// using sanctum
    //get the message

beforeEach(function () {
    Sanctum::actingAs(
        User::factory()->create(),
        ['*']
    );

    Message::factory()->create();
});

it('can get messages', function () {
    expect(true)->toBeTrue();
});
