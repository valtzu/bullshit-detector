<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class AllativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "allative";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou]i?|[äöy]i?|i|ee)lle$/u', $input);
	}
}