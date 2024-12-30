<?php

namespace App\Controllers;

use App\Models\City;

class WeatherController {
    public function handleRequest() {
        $city = null;
        $weather = null;
        $historicalWeather = null;
        $error = '';

        if($_SERVER['REQUEST_METHOD'] === 'POST'):
            $action = $_POST['action'] ?? '';
            $city = isset($_POST['city']) ? htmlspecialchars($_POST['city']) : null;

            if($city):
                try {
                    if($action === 'get_weather'):
                        $weather = $this->getWeather($city);
                    elseif($action === 'get_historical_weather'):
                        $year = htmlspecialchars($_POST['year'] ?? '');
                        $month = htmlspecialchars($_POST['month'] ?? '');
                        if($year && $month):
                            $historicalWeather = $this->getHistoricalWeather($city, $year, $month);
                        else:
                            throw new \InvalidArgumentException("Please select a valid year and month.");
                        endif;
                    endif;
                } catch(\Exception $e) {
                    $error = $e->getMessage();
                }
            else:
                $error = 'Please select a valid city.';
            endif;
        endif;

        include __DIR__ . '/../Views/form.php';
    }

    public function getWeather(string $selectedCity): array {
        $cities = City::getCities();

        if(!isset($cities[$selectedCity])):
            throw new \InvalidArgumentException("Invalid city selected.");
        endif;

        $latitude = $cities[$selectedCity]['latitude'];
        $longitude = $cities[$selectedCity]['longitude'];

        $url = "https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&current_weather=true";

        $response = file_get_contents($url);

        if($response === false):
            throw new \RuntimeException("Error fetching weather data.");
        endif;

        $data = json_decode($response, true);

        return $data['current_weather'] ?? [];
    }

    public function getHistoricalWeather(string $selectedCity, string $year, string $month): array {
        $cities = City::getCities();
    
        if(!isset($cities[$selectedCity])):
            throw new \InvalidArgumentException("Invalid city selected.");
        endif;
    
        $latitude = $cities[$selectedCity]['latitude'];
        $longitude = $cities[$selectedCity]['longitude'];
    
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));
    
        $url = "https://archive-api.open-meteo.com/v1/era5?latitude=$latitude&longitude=$longitude&start_date=$startDate&end_date=$endDate&hourly=temperature_2m";
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
    
        if($response === false):
            throw new \RuntimeException("Error fetching historical weather data.");
        endif;
    
        $data = json_decode($response, true);
    
        if(isset($data['hourly']['temperature_2m'], $data['hourly']['time'])):
            $hourlyTemps = $data['hourly']['temperature_2m'];
            $timestamps = $data['hourly']['time'];
    
            $dailyData = [];
            foreach($timestamps as $index => $timestamp):
                $date = explode('T', $timestamp)[0];
                if(!isset($dailyData[$date])):
                    $dailyData[$date] = [];
                endif;
                $dailyData[$date][] = $hourlyTemps[$index];
            endforeach;
    
            $dailyAverages = [];
            foreach($dailyData as $date => $temps):
                $dailyAverages[$date] = round(array_sum($temps) / count($temps), 2);
            endforeach;
    
            return $dailyAverages;
        endif;
    
        return [];
    }
    
}
