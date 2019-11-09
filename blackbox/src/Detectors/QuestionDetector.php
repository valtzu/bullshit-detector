<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class QuestionDetector implements DetectorInterface
{
	public const TAG = "question";

	function matches(string $input): bool
	{
		return preg_match('/^mi(tä|ssä|lloin|ksi|hin)|^k(u(ka|inka)|etä)/u', $input);
	}
}