<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class AblativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "ablative";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou]i?lta|([äöy]i?|i)ltä|e[ei]ltä)$/u', $input);
	}
}