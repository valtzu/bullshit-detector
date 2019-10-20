<?php

require_once 'vendor/autoload.php';

$startUrl = getenv('START_URL');

phpinfo();die();
die("FAAAK");

$app = new Blackbox\App($startUrl);
$app->run();
