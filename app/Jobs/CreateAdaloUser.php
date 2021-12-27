<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class CreateAdaloUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The Adalo User email.
     * The Adalo User collection Endpoint.
     *
     * @var string
     * @var string
     */
    protected $email, $endpoint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->endpoint = "https://api.adalo.com/v0/apps/" . env('ADALO_APP_ID') . '/' . env('ADALO_USER_COLLECTION_ID') . '/' . $this->email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        // get data from adalo
        $response = Http::get($this->endpoint);
        dd($response);
        // create a new user


        // set sanctum token


        // update adalo

    }
}
