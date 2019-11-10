<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class SuspiciousSubsequentConsonantDetector implements DetectorInterface
{
	public const TAG = "suspicious-subsequent-consonants";

	function matches(string $input): bool
	{
		return preg_match('/b[^aeiouyäöjlrv]|d[^aeiouyäölnrv]|f[^aeiouyäötgr]|g[^aeiouyäörmn]|h[^aeiouyäöktjdvnmlr]|j[^aeiouyäö]|l[^aeiouyäögtkmpjvlsh]|r[^aeiouyäötkmpjvshrn]|s[^aeiouyäötkpmnhvs]|t[^aeiouyäömskpjrvht]|p[^aeiouyäöpsrl]|k[^aeiouyäökntsrv]|n[^aeiouyäögkntpshj]|m[^aeiouyäömps]|v[^aeiouyäö]|w|z|[^aeiouyäö]{3,}]/ui', $input);
	}
}