<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class ElativeGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "elative";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou][ei]?sta|([äöy][ei]?|i)stä|e[ei]st[aä])$/u', $input);
	}
}