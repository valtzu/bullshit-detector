<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class ParticleDetector implements DetectorInterface
{
	function isSuspicious(string $input): bool
	{
		return !preg_match('/\b(ja|tai|myös|kun|jos|että|mukaan|mutta|jopa|kautta|kuin|asti)\b/u', $input);
	}
}