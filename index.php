<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\WeatherController;

// Starting controllers
$controller = new WeatherController();
$controller->handleRequest();
