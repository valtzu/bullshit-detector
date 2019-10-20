<?php

namespace Blackbox\Bullshit;

abstract class Response
{
	protected array $data;

	public final function __construct(array $data)
	{
		$this->data = $data;
	}
}