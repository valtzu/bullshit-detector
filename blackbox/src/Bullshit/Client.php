<?php

namespace Blackbox\Bullshit;

use Blackbox\Bullshit\Responses\BullshitResponse;
use Blackbox\Bullshit\Responses\StartResponse;
use Blackbox\Http\Client as HttpClient;
use Blackbox\Http\Exception as HttpException;
use JsonException;

class Client
{
	private HttpClient $httpClient;
	private string $endpoint;
	private ?StartResponse $start = null;

	public function __construct(string $endpoint, ?HttpClient $client = null)
	{
		$this->httpClient = $client ?? new HttpClient;
		$this->endpoint = $endpoint;
	}

	/**
	 * Get bullshit messages
	 *
	 * @return BullshitResponse
	 * @throws Exception
	 */
	public function getBullshit(): BullshitResponse
	{
		if ($this->start === null)
			$this->start = $this->start();

		return new BullshitResponse($this->get($this->start->getBullshitUrl()));
	}

	/**
	 * @return StartResponse
	 * @throws Exception
	 */
	private function start(): StartResponse
	{
		return new StartResponse($this->get($this->endpoint));
	}

	/**
	 * Get response as array
	 *
	 * @param string $url
	 * @return array
	 * @throws Exception
	 */
	private function get(string $url): array
	{
		try {
			$responseBody = $this->httpClient->get($url, $this->getRequestHeaders());
			return json_decode($responseBody, true, 8, JSON_THROW_ON_ERROR);
		} catch (HttpException | JsonException $e) {
			throw new Exception("Failed to get {$url}", 0, $e);
		}
	}

	/**
	 * Get request headers for HTTP request
	 *
	 * @return array
	 * @throws Exception
	 */
	private function getRequestHeaders()
	{
		$headers = [];

		if ($this->start !== null)
			$headers[] = "Authorization: Bearer {$this->start->getJwtToken()}";

		return $headers;
	}
}