<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class InessiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "inessive";

	function matches(string $input): bool
	{
		return preg_match('/([aou][^aeiouyäö]*[ei]?ssa|([äöy][ei]?|i)ssä|e[ei]ssä)\b/u', $input);
	}
}