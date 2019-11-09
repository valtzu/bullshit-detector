<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class ParticleDetector implements DetectorInterface
{
	public const TAG = "particle";

	function matches(string $input): bool
	{
		return preg_match('/^(ja|sekä|eli|tai|vai|myös|kun|koska|kunnes|jos|ett(ä|ei)|josta|johon|jott(a|ei)|mukaan|mutt(a|ei)|jopa|kautta|kuin|asti)$/u', $input);
	}
}