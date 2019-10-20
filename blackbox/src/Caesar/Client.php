<?php

namespace Blackbox\Caesar;

use Blackbox\Tcp\Client as TcpClient;
use Blackbox\Tcp\Exception as TcpException;

class Client
{
	private TcpClient $tcpClient;

	/**
	 * @param string $endpoint
	 * @throws Exception
	 */
	public function __construct(string $endpoint)
	{
		$url = parse_url($endpoint);
		if ($url['scheme'] !== 'tcp')
			throw new Exception("Only tcp endpoints supported");

		if (empty($url['port']))
			throw new Exception("Missing port from the endpoint");

		$this->tcpClient = new TcpClient($url['host'], $url['port']);
	}

	/**
	 * Get all possible permutations of a string.
	 *
	 * @param string $input
	 * @return \Generator|string[]
	 * @throws Exception
	 */
	public function getAllPermutations(string $input)
	{
		try {
			$this->tcpClient->connect();

			$this->tcpClient->writeLine($input);
			while (!$this->tcpClient->endOfStream() && $line = $this->tcpClient->readLine())
				yield $line;

			$this->tcpClient->close();
		} catch (TcpException $e) {
			throw new Exception("Failed to get all permutations", 0, $e);
		}
	}
}