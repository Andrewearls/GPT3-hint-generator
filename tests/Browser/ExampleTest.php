<?php
 
use Laravel\Dusk\Browser;
use App\Models\User;
use App\Events\MessageUser;

beforeEach(function () {
    $this->user = User::factory()->create();
});

it('has homepage', function () {
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
            ->assertSee('Laravel');
    });
});

//make a test to check the channel path

test('user recives message', function () {
    $message = 'I am sending you a message';

    $this->browse(function (Browser $browser) use ($message) {
        $browser->loginAs($this->user)
            ->visit(route('messages'));
            // ->assertSee('channel ' . $this->user->id);

        MessageUser::dispatch($message, $this->user);

        $browser->waitForText($message)
            ->assertSee($message);
    });
});