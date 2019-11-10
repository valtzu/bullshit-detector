<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class ToBeVerbDetector implements DetectorInterface
{
	public const TAG = "to-be-verb";

	function matches(string $input): bool
	{
		return preg_match('/^o(n|l(l(a|ut|eet)|([ei]|isi)(n|t(te)?)?)|(li(si)?)?vat)(kin|kaan|han|pa)?$/u', $input);
	}
}