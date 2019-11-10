<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class PluralInflectionDetector implements DetectorInterface
{
	public const TAG = "plural-inflection";

	function matches(string $input): bool
	{
		return preg_match('/[aeiouyäö](tt|mm|nn)e(kin|k[aä]{2}n|h[aä]n|p[aä])?$/u', $input);
	}
}