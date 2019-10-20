<?php

namespace Blackbox;

use Blackbox\Detectors\ConsonantDetector;
use Blackbox\Detectors\GrammaticalCaseDetector;
use Blackbox\Detectors\ParticleDetector;
use IteratorAggregate;

class DetectorFactory implements IteratorAggregate
{
	public const DETECTOR_CONSONANT = 'consonant';
	public const DETECTOR_GRAMMATICAL_CASE = 'grammaticalCase';
	public const DETECTOR_PARTICLE = 'particle';

	/**
	 * Create new detector using name (see DETECTOR_* constants)
	 *
	 * @param string $name
	 * @return DetectorInterface
	 * @throws Exception
	 */
	public function create(string $name): DetectorInterface
	{
		switch($name)
		{
			case self::DETECTOR_CONSONANT:
				return new ConsonantDetector;
			case self::DETECTOR_GRAMMATICAL_CASE:
				return new GrammaticalCaseDetector;
			case self::DETECTOR_PARTICLE:
				return new ParticleDetector;
			default:
				throw new Exception("What the heck is {$name}");
		}
	}

	/**
	 * @return \Generator|\Traversable|DetectorInterface[]
	 * @throws Exception
	 */
	public function getIterator()
	{
		$all = [
			self::DETECTOR_CONSONANT,
			self::DETECTOR_GRAMMATICAL_CASE,
			self::DETECTOR_PARTICLE,
		];

		foreach ($all as $name)
		{
			yield $this->create($name);
		}
	}
}