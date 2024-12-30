<?php

if(!empty($weather)):
    echo "<h2>Weather in $city</h2>";
    echo "<p>Temperature: " . $weather['temperature'] . "°C</p>";
    echo "<p>Wind Speed: " . $weather['windspeed'] . " km/h</p>";
endif;

if(!empty($historicalWeather)):
    echo "<h2>Historical Weather in $city</h2>";
    echo "<ul>";
    foreach($historicalWeather as $time => $temperature):
        echo "<li>$time: $temperature°C</li>";
    endforeach;
    echo "</ul>";
endif;

if(!empty($error)):
    echo "<p style='color: red;'>Error: $error</p>";
endif;
