<?php

namespace App\Services\Adalo;

use Illuminate\Support\Facades\Http;

class Connection
{
	private string $apiAppId;

	private string $apiCollectionId;

	private string $url;

	private string $bearerToken;

	// private GuzzleClient $guzzle;

	/**
	 * Construct a new instance.
	 *
	 * @param string apiCollectionId
	 * @return array GuzzleClient
	 */
	public function __construct(string $apiCollectionId)
	{
		$this->apiAppId = env('ADALO_APP_ID');

		$this->apiCollectionId = $apiCollectionId;

		$this->bearerToken = env('ADALO_BEARER_TOKEN');

		$this->url = sprintf('https://api.adalo.com/apps/%1$s/collections/%2$s', self::apiAppId, self::apiCollectionId);

		// $this->guzzle = new GuzzleClient([
		// 	'base_uri' => sprintf('https://api.adalo.com/apps/%1$s/collections/%2$s', self::apiAppId, self::apiCollectionId),
		// 	'headers' => $headers,
		// ]);
	}

	/**
	 * Return the guzzleClient.
	 *
	 * @return GuzzleClient
	 */
	// public function guzzleClient() : GuzzleClient
	// {
	// 	return $this->guzzle;
	// }

	// get all collection records
	/**
	 * Get all collection records.
	 *
	 * @return json_decode variable
	 */
	public function getAll()
	{
		$response = Http::accept('application/json')
			->withToken($this->bearerToken)
			->get($this->url);

	}

	// add a collection record

	// fetch a single collection record

	// delete a single collection record

	// update a record in the specified collection
}