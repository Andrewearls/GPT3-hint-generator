<?php

namespace App\Jobs\Adalo;

use App\Services\Adalo\MessageCollectionConnection as client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class MessageUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $conversation;
    public $message;

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
        //use the adalo service to send message to Adalo
        $AdaloMessages = new Client();
        $AdaloMessages->persist($this->conversation, $this->message);
    }
}
