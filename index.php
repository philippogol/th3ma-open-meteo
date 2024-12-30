<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'):
    
    $cities = [
        'New York' => ['latitude' => 40.7128, 'longitude' => -74.0060],
        'Tokyo' => ['latitude' => 35.6895, 'longitude' => 139.6917],
        'London' => ['latitude' => 51.5074, 'longitude' => -0.1278],
        'Zurich' => ['latitude' => 47.3769, 'longitude' => 8.5417],
        'Paris' => ['latitude' => 48.8566, 'longitude' => 2.3522],
    ];

    $selectedCity = $_POST['city'];
    $latitude = $cities[$selectedCity]['latitude'];
    $longitude = $cities[$selectedCity]['longitude'];

    $url = "https://api.open-meteo.com/v1/forecast?latitude=$latitude&longitude=$longitude&current_weather=true";

    $response = file_get_contents($url);
    if($response === FALSE):
        die('Error occurred while fetching weather data');
    endif;

    $data = json_decode($response, true);
    if(isset($data['current_weather'])):
        $currentWeather = $data['current_weather'];
        echo "<h2>Weather in $selectedCity</h2>";
        echo "<p>Temperature: " . $currentWeather['temperature'] . "°C</p>";
        echo "<p>Wind Speed: " . $currentWeather['windspeed'] . " km/h</p>";
    else:
        echo "<p>No current weather data available for $selectedCity.</p>";
    endif;
endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>
<body>
    <h1>Select a City to View Weather</h1>
    <form method="POST">
        <label for="city">Choose a city:</label>
        <select id="city" name="city">
            <option value="New York">New York</option>
            <option value="Tokyo">Tokyo</option>
            <option value="London">London</option>
            <option value="Zurich">Zurich</option>
            <option value="Paris">Paris</option>
        </select>
        <button type="submit">Get Weather</button>
    </form>
</body>
</html>
