<?php

namespace App\Services\Adalo;

use Illuminate\Support\Facades\Http;

class Connection
{
	public string $apiAppId;

	public string $apiCollectionId;

	private string $url;

	private string $bearerToken;

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

		$this->url = sprintf('https://api.adalo.com/apps/%1$s/collections/%2$s', $this->apiAppId, $this->apiCollectionId);

	}

	/**
	 * Get all collection records.
	 *
	 * @return HTTP response
	 */
	public function getAll()
	{
		return Http::accept('application/json')
			->withToken($this->bearerToken)
			->get($this->url);
	}

	/**
	 * Add a collection record.
	 *
	 * @param string record
	 * @return HTTP response
	 */
	public function save(string $record)
	{
		return Http::accept('application/json')
			->withToken($this->bearerToken)
			->post($this->url, [
				'Message Text' => $record,
			]);
	}

	/**
	 * Get a single collection record.
	 *
	 * @return HTTP response
	 */
	public function getOne($id)
	{
		return Http::accept('application/json')
			->withToken($this->bearerToken)
			->get($this->url . '/' . $id);
	}

	/**
	 * Delete a single collection record.
	 *
	 * @return HTTP response
	 */
	public function delete($id, string $record)
	{
		return Http::accept('application/json')
			->withToken($this->bearerToken)
			->put($this->url . '/' . $id, [
				'Message Text' => $record,
			]);
	}

	// update a record in the specified collection
}