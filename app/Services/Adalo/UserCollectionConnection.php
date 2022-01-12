<?php

namespace App\Services\Adalo;

use App\Models\User;

class UserCollectionConnection extends Connection
{

	/**
	 * Create a new service instance.
	 *
	 * @return json
	 */
	public function __construct()
	{
		parent::__construct(env('ADALO_USER_COLLECTION_ID'))
	}

}