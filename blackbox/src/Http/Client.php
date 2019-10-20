<?php

namespace Blackbox\Http;

class Client
{
	private const STATUS_OK = 200;
	private const STATUS_UNAUTHORIZED = 401;
	private const STATUS_FORBIDDEN = 403;

	/**
	 * Perform a GET request to an url
	 *
	 * @param string $url
	 * @param array $headers
	 * @return string
	 * @throws Exception
	 */
	public function get(string $url, array $headers = []): string
	{
		$context = stream_context_create([
			'http' => [
				'header' => $headers,
				'ignore_errors' => true,
			],
		]);

		$body = file_get_contents($url, false, $context);
		return $this->parseResponse($http_response_header, (string)$body);
	}

	/**
	 * Parse HTTP response
	 *
	 * @param array $headers
	 * @param string $body
	 * @return string
	 * @throws Exception
	 */
	private function parseResponse(array $headers, string $body): string
	{
		if (!preg_match(':HTTP/\S*\s(?<statusCode>\d{3}):', $headers[0] ?? '', $match))
			throw new Exception("No http status found!");

		$statusCode = (int)$match['statusCode'];

		switch ($statusCode)
		{
			case self::STATUS_OK:
				return $body;

			case self::STATUS_FORBIDDEN:
			case self::STATUS_UNAUTHORIZED:
				throw new AccessDeniedException("No access to the requested resource", $statusCode);

			default:
				throw new Exception("Unexpected HTTP status {$statusCode}", $statusCode);
		}
	}
}