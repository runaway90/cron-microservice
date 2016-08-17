#!/usr/bin/env php
<?php

use Symfony\Component\Process\Process;

set_time_limit(0);

/**
 * @var Composer\Autoload\ClassLoader $loader
 */
$loader = require __DIR__.'/../symfony/autoload.php';

sleep(1);

$process = new Process("rm -rf ".dirname(__DIR__).'/var/cache');
$process->run();
echo $process->getErrorOutput();

$process = new Process("php ".dirname(__DIR__).'/bin/console doctrine:schema:update --force');
$process->run();
echo $process->getErrorOutput();

$process = new Process("rm -rf ".dirname(__DIR__).'/var/cache');
$process->run();
echo $process->getErrorOutput();

exit;
