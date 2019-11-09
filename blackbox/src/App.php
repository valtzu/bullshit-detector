<?php

namespace Blackbox;

use Blackbox\Bullshit\Client as BullshitClient;
use Blackbox\Bullshit\Exception as BullshitException;
use Blackbox\Caesar\Client as CaesarClient;
use Blackbox\Caesar\Exception as CaesarException;

class App
{
	private ScoreCalculator $scoreCalculator;
	private BullshitClient $bullshitClient;
	private CaesarClient $caesarClient;

	/**
	 * App constructor.
	 *
	 * @param string $bullshitEndpoint
	 * @param string $caesarEndpoint
	 * @throws CaesarException
	 */
	public function __construct(string $bullshitEndpoint, string $caesarEndpoint)
	{
		$this->scoreCalculator = new ScoreCalculator;
		$this->bullshitClient = new BullshitClient($bullshitEndpoint);
		$this->caesarClient = new CaesarClient($caesarEndpoint);
	}

	public function run()
	{
		header("Access-Control-Allow-Origin: *");

		switch ($_SERVER['REDIRECT_URL'])
		{
			case '/bullshits':
				$output = $this->bullshitClient->getBullshit()->getMessages();
				break;

			case '/inspect':
				$output = [
					'message' => $message = $_GET['message'],
					'results' => [],
				];

				foreach ($this->caesarClient->getAllPermutations($message) as $permutation) {
					$this->scoreCalculator->setPhrase($permutation);
					$this->scoreCalculator->process();

					if ($this->scoreCalculator->getScore() < 1)
						continue;

					$output['results'] = $this->scoreCalculator->getInterpretation();
				}

				break;

			default:
				http_response_code(404);
				exit;
		}

		header("Content-Type: application/json; charset=utf-8");
		echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
	}
}