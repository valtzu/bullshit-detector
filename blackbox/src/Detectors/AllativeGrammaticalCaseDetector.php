<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class AllativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "allative";

	function matches(string $input): bool
	{
		return preg_match('/([aou]i?|[äöy]i?|i|(e|[^aeiouyäö])e)lle$/u', $input);
	}
}