<?php

# 自动加载
require "vendor/autoload.php";

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('Redis');
$log->pushHandler(new StreamHandler(__DIR__ . '.redis.log', Logger::WARNING));

// add records to the log
$log->warning('redis_warning');
$log->error('redis_error');