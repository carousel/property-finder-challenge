<?php

require __DIR__ . '/bootstrap.php';
use Trip\Trip;

/**
 * FRONT CONTROLLER
 * @
 */


$trip = new Trip($data);
$trip->init();
$trip->output();



