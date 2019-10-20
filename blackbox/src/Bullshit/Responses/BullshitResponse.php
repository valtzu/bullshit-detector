<?php

namespace Blackbox\Bullshit\Responses;

use Blackbox\Bullshit\Exception;
use Blackbox\Bullshit\Response;

class BullshitResponse extends Response
{
	/**
	 * Get the bullshit messages
	 *
	 * @return string[]
	 * @throws Exception
	 */
	public function getMessages(): array
	{
		$bullshits = $this->data['bullshits'] ?? [];
		if (!$bullshits)
			throw new Exception("Response does not contain any bullshit");

		return array_column($bullshits, 'message');
	}
}