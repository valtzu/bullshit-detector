<?php

namespace Blackbox;

interface DetectorInterface
{
	function matches(string $input): bool;
}