<?php

namespace Blackbox;

interface DetectorInterface
{
	function isSuspicious(string $input): bool;
}