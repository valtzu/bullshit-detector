<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class GrammaticalCaseDetector implements DetectorInterface
{
	function isSuspicious(string $input): bool
	{
		$count = 0;
		$count += $this->countPartitives($input);
		$count += $this->countGenitives($input);
		$count += $this->countInessives($input);
		$count += $this->countElatives($input);
		$count += $this->countIllatives($input);
		$count += $this->countAdessives($input);
		$count += $this->countAblatives($input);
		$count += $this->countAllatives($input);
		$count += $this->countTranslatives($input);

		return $count < 6;
	}

	private function countPartitives($input)
	{
		return preg_match_all('/([aou]a|[äöyi]ä|että|utta)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countGenitives($input)
	{
		return preg_match_all('/([^aeiouyäö][aeiouyäö]n)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countInessives($input)
	{
		return preg_match_all('/([aou][ei]?ssa|[äöyi]ssä|eessä)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countElatives($input)
	{
		return preg_match_all('/([aou][ei]?sta|[äöyi]stä|eestä)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countIllatives($input)
	{
		return preg_match_all('/([aouiyäö]{2}n|eeseen)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countAdessives($input)
	{
		return preg_match_all('/([aou][ei]?lla|[äöyi]llä|eellä)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countAblatives($input)
	{
		return preg_match_all('/([aou][ei]?lta|[äöyi]ltä|eeltä)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countAllatives($input)
	{
		return preg_match_all('/([aou][ei]?lle|[äöyi]lle|eelle)\b/u', $input, $m) ? count($m[0]) : 0;
	}

	private function countTranslatives($input)
	{
		return preg_match_all('/([aeiouyäö]ksi)\b/u', $input, $m) ? count($m[0]) : 0;
	}
}