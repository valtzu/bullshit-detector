<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class EssiveGrammaticalCaseDetector implements DetectorInterface
{
	public const TAG = "essive";

	function matches(string $input): bool
	{
		return preg_match('/[^aeiouyäö]([aou]i?na|([äöy]i?|i)nä|e[ei]n[aä])$/u', $input);
	}
}