<?php

use PHPUnit\Framework\TestCase;
use Blackbox\Bullshit\Client as BullshitClient;
use Blackbox\Http\Client as HttpClient;

class BullshitClientTest extends TestCase
{
	public function testGetBullshitSuccess()
	{
		$startUrl = 'start';
		$token = 'abcdef123';
		$bullshitUrl = 'bulsit';
		$messages = [];

		$startResponse = json_encode([
			'jwtToken' => $token,
			'bullshitUrl' => $bullshitUrl,
		]);

		$bullshitResponse = json_encode([
			'bullshits' => [
				['message' => $messages[] = 'abc'],
				['message' => $messages[] = 'def'],
				['message' => $messages[] = 'ghi'],
			],
		]);

		$httpClient = $this->createMock(HttpClient::class);
		$httpClient
			->expects($this->exactly(2))
			->method('get')
			->withConsecutive([$startUrl, []], [$bullshitUrl, ["Authorization: Bearer {$token}"]])
			->willReturnOnConsecutiveCalls($startResponse, $bullshitResponse);

		$client = new BullshitClient($startUrl, $httpClient);
		$bullshitResponse = $client->getBullshit();
		$this->assertEquals($messages, $bullshitResponse->getMessages());
	}
}