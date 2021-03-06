<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class CreateAdaloUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The Adalo User email.
     * The Adalo User Full Name.
     * The Adalo User collection Endpoint.
     *
     * @var string email
     * @var string url
     */
    protected $email, $endpoint;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $name)
    {
        $this->email = $email;

        // this should be a service container
        $this->endpoint = "https://api.adalo.com/v0/apps/" . env('ADALO_APP_ID') . '/collections/' . env('ADALO_USER_COLLECTION_ID');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Use integromat to get the user ID
        // Get the user
        // set the user adalo relationship
    }
}
