<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/data.php';

use Monolog\ErrorHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Carousel\Container;

$logger = new Logger('broker-logger');
ErrorHandler::register($logger);
$handler = new ErrorHandler($logger);
$handler->registerErrorHandler([], false);
$handler->registerExceptionHandler();
$handler->registerFatalHandler();
$logger->pushHandler(new StreamHandler('./logger.log', Logger::WARNING));


$container = new Container;
