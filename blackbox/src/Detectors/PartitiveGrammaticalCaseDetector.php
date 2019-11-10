<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class PartitiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "partitive";

	function matches(string $input): bool
	{
		return preg_match('/(([^aeiouyäö]([aou]i?|aust|i)a|[äöy]i?ä|[^aeiouyäö][eä]ttä|[^aeiouyäö]eitä|[^aeioyäö]utta)|ksi[aä]|[öi]tä|[oi]ta)$/u', $input);
	}
}