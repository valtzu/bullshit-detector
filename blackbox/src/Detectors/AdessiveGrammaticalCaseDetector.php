<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class AdessiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "adessive";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou][ei]?lla|([äöy][ei]?|i)llä|e[ei]llä)$/u', $input);
	}
}