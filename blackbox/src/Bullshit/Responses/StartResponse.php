<?php

namespace Blackbox\Bullshit\Responses;

use Blackbox\Bullshit\Exception;
use Blackbox\Bullshit\Response;

class StartResponse extends Response
{
	/**
	 * Get the JWT token
	 *
	 * @return string
	 *@throws Exception
	 */
	public function getJwtToken(): string
	{
		$token = $this->data['jwtToken'] ?? null;
		if (empty($token))
			throw new Exception("Response does not contain jwt token");

		return $token;
	}

	/**
	 * Get the bullshit url
	 *
	 * @throws Exception
	 * @return string
	 */
	public function getBullshitUrl(): string
	{
		$url = $this->data['bullshitUrl'] ?? null;
		if (empty($url))
			throw new Exception("Response does not contain bullshit url");

		return $url;
	}
}