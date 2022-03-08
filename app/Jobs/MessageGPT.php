<?php

namespace App\Jobs;

use App\Jobs\Adalo\MessageUser as AdaloMessageUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Set up a client with your API key.
use SiteOrigin\OpenAI\Client;
use SiteOrigin\OpenAI\Engines;

class MessageGPT implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message, $client, $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message, $conversation)
    {
        $this->message      = $message;
        $this->conversation = $conversation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // this should be a service
        // create a client with API key
        $this->client = new Client($_ENV['OPENAI_API_KEY']);

        // request an Answer from GPT-3
        $documents = [
            "The treasure is in Salem Oregon.",
            "The treasure is in a local park",
            "The treasure is under a tree",
            "The treasure is a pile of gold.",
            "The treasure is past the world",
            "The treasure is over the bridge",
            "The treasure is through the woods",
            "The treasure is near the water",
            "A hint might be, look down",
            "A hint might be, look up",
            "A hint might be, near the water",
            "A hint might be, look closely",
            "The treasure is not near the bridge",
        ];
        $a = $this->client->answers(Engines::DAVINCI)->create(
            $this->message,
            $documents, // Or a file-id
            'The treasure is hidden verry well',
            [
                [
                    "How old is the treasure?",
                    "The treasure is old enough to exist.",
                ],
                [
                    "Where is the car?",
                    "The car is parked on the street.",
                ],
            ],
            ["max_tokens" => 15, "stop" => ["\n", "<|endoftext|>"]]
        );

        $response = head($a->answers);

        // broadcast(new MessageUser($response, $this->user));

        AdaloMessageUser::dispatch($response, $this->conversation);
    }
}
