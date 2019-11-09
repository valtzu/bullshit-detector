<?php

require_once 'vendor/autoload.php';

$bullshitEndpoint = getenv('BULLSHIT_ENDPOINT');
$caesarEndpoint = getenv('CAESAR_ENDPOINT');

$app = new Blackbox\App($bullshitEndpoint, $caesarEndpoint);
$app->run();