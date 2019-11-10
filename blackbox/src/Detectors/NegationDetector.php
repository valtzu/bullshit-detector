<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class NegationDetector implements DetectorInterface
{
	public const TAG = "negation";

	function matches(string $input): bool
	{
		return preg_match('/^e((n|t|i(vät)?)(hän)?|ikä)$/u', $input);
	}
}