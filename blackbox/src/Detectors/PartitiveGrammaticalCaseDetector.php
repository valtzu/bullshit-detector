<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class PartitiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "partitive";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou]i?a|[äöy]i?ä|[^aeiouyäö]että|[^aeiouyäö]utta)$/u', $input);
	}
}