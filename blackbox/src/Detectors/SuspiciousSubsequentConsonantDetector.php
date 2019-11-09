<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class SuspiciousSubsequentConsonantDetector implements DetectorInterface
{
	public const TAG = "suspicious-subsequent-consonants";

	function matches(string $input): bool
	{
		return preg_match('/b[^aeiouyäöjlrv]|d[^aeiouyäölnrv]|f[^aeiouyäötgr]|g[^aeiouyäörmn]|l[^aeiouyäögtkmpjvlsh]|r[^aeiouyäötkmpjvshn]|h[^aeiouyäötdkmjnvlr]|s[^aeiouyäötkpmnhvs]|t[^aeiouyäömskpjrvht]|p[^aeiouyäösrl]|k[^aeiouyäökntsrv]|n[^aeiouyäögktpshj]|m[^aeiouyäömps]|w|z|[^aeiouyäö]{3,}]/ui', $input);
	}
}