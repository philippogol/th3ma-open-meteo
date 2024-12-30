<?php

namespace App\Models;

class City {
    public static function getCities(): array
    {
        return [
            'New York' => ['latitude' => 40.7128, 'longitude' => -74.0060],
            'Tokyo' => ['latitude' => 35.6895, 'longitude' => 139.6917],
            'London' => ['latitude' => 51.5074, 'longitude' => -0.1278],
            'Zurich' => ['latitude' => 47.3769, 'longitude' => 8.5417],
            'Paris' => ['latitude' => 48.8566, 'longitude' => 2.3522],
        ];
    }
}
