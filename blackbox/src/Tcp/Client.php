<?php

namespace Blackbox\Tcp;

class Client
{
	/** @var resource */
	private $socket = null;

	private string $host;

	private int $port;

	public function __construct(string $host, int $port)
	{
		$this->host = $host;
		$this->port = $port;
	}

	/**
	 * Connect to the server
	 *
	 * @throws Exception
	 */
	public function connect(): void
	{
		$this->socket = fsockopen($this->host, $this->port, $errNo, $errStr, 5);
		if (!$this->socket)
			throw new Exception("Failed to connect to {$this->host}:{$this->port}: {$errStr} ({$errNo})");
	}

	/**
	 * Close the connection to the server
	 *
	 * @throws Exception
	 */
	public function close(): void
	{
		if (!$this->socket)
			return;

		if (!fclose($this->socket))
			throw new Exception("Failed to close the connection");
	}

	/**
	 * Send line to the server
	 *
	 * @param string $line
	 * @throws Exception
	 */
	public function writeLine(string $line): void
	{
		if (!fwrite($this->socket, "{$line}\n"))
			throw new Exception("Failed to write data to the stream");
	}

	/**
	 * Read line from the server
	 *
	 * @return string
	 * @throws Exception
	 */
	public function readLine(): string
	{
		if (($data = fgets($this->socket)) === false)
			throw new Exception("Failed to write data to the stream");

		return rtrim($data, "\n");
	}

	public function endOfStream(): bool
	{
		return feof($this->socket);
	}
}