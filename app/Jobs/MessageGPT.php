<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events\MessageUser;

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
    public function __construct($message, $user)
    {
        $this->message = $message;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // create a client with API key
        $this->client = new Client($_ENV['OPENAI_API_KEY']);

        // request an Answer from GPT-3
        $documents = [
            "Treasure is in Salem Oregon.",
            "Treasure is in a local park",
            "Treasure is under a tree",
            "The Treasure is a pile of gold."
        ];
        $a = $this->client->answers(Engines::DAVINCI)->create(
            $this->message,
            $documents, // Or a file-id
            'The treasure is hidden verry well, you may not find it.',
            [
                [
                    "Where is the treasure hidden?",
                    "One strand dangles. Two strands twist.
Three or more can fashion this."
                ],
                [
                    "Can you give me a clue?",
                    "What can travel around the world while staying in a corner?"
                ]
            ],
            ["max_tokens" => 15, "stop" => ["\n", "<|endoftext|>"] ]
        );

        $response = head($a->answers);

        broadcast(new MessageUser($response, $this->user));
    }
}
