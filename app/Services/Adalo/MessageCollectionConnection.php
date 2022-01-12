<?php

namespace App\Services\Adalo;

use App\Models\User;

class MessageCollectionConnection extends Connection
{

	/**
	 * Create a new service instance.
	 *
	 * @return json
	 */
	public function __construct()
	{
		parent::__construct(env('ADALO_MESSAGE_COLLECTION_ID'))
	}

}