<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;

class AdaloUserRepository
{
	protected $url;
	protected $appId;
	protected $collection;
	protected $bearerToken;

	/**
	 * Create a new service instance.
	 *
	 * @param HTTP instance
	 * @return json
	 */
	public function __construct(Http $http)
	{
		$this->app = env('ADALO_APP_ID');
		$this->collection['user'] = env('ADALO_USER_COLLECTION_ID');
		$this->url = "https://api.adalo.com/v0/apps/";
	}

	/**
	 * Retrieve all records from a collection.
	 *
	 * @param int limit optional
	 * @param int offset optional
	 * @return json
	 */	
	// public function getResponse($collection, $offset = 0, $limit = 100)
	// {
	// 	# code...
	// }

	// This should be broken up into two other services
	// One should be an adalo connection service
	// The other should be a message repository service
	// This user repository service should remain
	/**
	 * Insert record into message collection.
	 *
	 * @param Model/User
	 * @param Message
	 */
	public function SendMessage(User $user)
	{
		# code...
	}

}