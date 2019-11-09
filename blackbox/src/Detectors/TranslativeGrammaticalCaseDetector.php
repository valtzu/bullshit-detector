<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class TranslativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "translative";

	function matches(string $input): bool
	{
		return preg_match('/([aeiouyäö]ksi)$/u', $input);
	}
}