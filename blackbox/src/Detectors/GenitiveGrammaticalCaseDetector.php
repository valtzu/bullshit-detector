<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class GenitiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "genitive";

	function matches(string $input): bool
	{
		return preg_match('/(([^aeiouyäö][aeiouyäö]|[tlr]ee)n)$/u', $input);
	}
}