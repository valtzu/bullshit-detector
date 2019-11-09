<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class IllativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "illative";

	function matches(string $input): bool
	{
		return preg_match('/(([aouiyäö])\2n|eeseen|eisiin)$/u', $input);
	}
}