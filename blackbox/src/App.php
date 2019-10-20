<?php

namespace Blackbox;

use Blackbox\Bullshit\Client as BullshitClient;

class App
{
	private DetectorFactory $detectorFactory;
	private BullshitClient $bullshitClient;

	public function __construct($startUrl)
	{
		$this->detectorFactory = new DetectorFactory;
		$this->bullshitClient = new BullshitClient($startUrl);
	}

	public function run()
	{
		var_dump($this->bullshitClient->getBullshit()->getMessages());
	}
}