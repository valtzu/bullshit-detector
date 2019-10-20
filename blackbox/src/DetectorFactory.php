<?php

namespace Blackbox;

use Blackbox\Detectors\ConsonantDetector;
use IteratorAggregate;

class DetectorFactory implements IteratorAggregate
{
	public const DETECTOR_CONSONANT = 'consonant';

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
			default:
				throw new Exception("What the heck is {$name}");
		}
	}

	public function getIterator()
	{
		$all = [
			self::DETECTOR_CONSONANT
		];

		foreach ($all as $name)
		{
			yield $this->create($name);
		}
	}
}