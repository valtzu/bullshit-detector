<?php

namespace Blackbox\Detectors;

use Blackbox\DetectorInterface;

class ConsonantDetector implements DetectorInterface
{
	function isSuspicious(string $input): bool
	{
		return preg_match('/b[^aeiouyöäjlrv]|c|d[^aeiouyöälnrv]|f[^aeiouyöätgr]|g[^aeiouyöärmn]|l[^aeiouyöägtkmpjvlsh]|r[^aeiouyöätkmpjvshn]|h[^aeiouyöätdkmjnvlr]|s[^aeiouyöätkpmnhvs\W]|t[^aeiouyöämskpjrvht\W]|p[^aeiouyöäsrl]|k[^kaeiouyöäntsrv]|n[^aeiounyöäktpshj\W]|m[^aeiouyöäps]|z/ui', $input);
	}
}