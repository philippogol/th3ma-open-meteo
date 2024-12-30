<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\WeatherController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $city = htmlspecialchars($_POST['city']);
    $controller = new WeatherController();

    try {
        $weather = $controller->getWeather($city);
        include __DIR__ . '/../app/Views/weather.php';
    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
} else {
    include __DIR__ . '/../app/Views/form.php';
}
