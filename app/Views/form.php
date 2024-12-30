<form method="POST" action="">
    <label for="city">Choose a city:</label>
    <select id="city" name="city">
        <option value="" disabled <?= empty($city) ? 'selected' : '' ?>>Select a city</option>
        <option value="New York" <?= $city === 'New York' ? 'selected' : '' ?>>New York</option>
        <option value="Tokyo" <?= $city === 'Tokyo' ? 'selected' : '' ?>>Tokyo</option>
        <option value="London" <?= $city === 'London' ? 'selected' : '' ?>>London</option>
        <option value="Zurich" <?= $city === 'Zurich' ? 'selected' : '' ?>>Zurich</option>
        <option value="Paris" <?= $city === 'Paris' ? 'selected' : '' ?>>Paris</option>
    </select>

    <button type="submit" name="action" value="get_weather">Get Weather</button>
    
    <br><br>

    <label for="year">Select Year:</label>
    <select id="year" name="year">
        <option value="2024" selected>2024</option>
    </select>

    <label for="month">Select Month:</label>
    <select id="month" name="month">
        <option value="" disabled selected>Select a month</option>
        <option value="01">January</option>
        <option value="02">February</option>
        <option value="03">March</option>
        <option value="04">April</option>
        <option value="05">May</option>
        <option value="06">June</option>
        <option value="07">July</option>
        <option value="08">August</option>
        <option value="09">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
    </select>

    <button type="submit" name="action" value="get_historical_weather">Get Historical Weather</button>
</form>

<?php if(!empty($error)): ?>
    <p style="color: red;">Error: <?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php if(!empty($weather)): ?>
    <h2>Current Weather in <?= htmlspecialchars($city) ?></h2>
    <p>Temperature: <?= htmlspecialchars($weather['temperature']) ?>°C</p>
    <p>Wind Speed: <?= htmlspecialchars($weather['windspeed']) ?> km/h</p>
<?php endif; ?>

<?php if(!empty($historicalWeather)): ?>
    <h2>Historical Weather in <?= htmlspecialchars($city) ?> for <?= htmlspecialchars("$year-$month") ?></h2>
    <table border="1">
        <thead>
            <tr>
                <th>Date</th>
                <th>Average Temperature (°C)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($historicalWeather as $date => $avgTemp): ?>
                <tr>
                    <td><?= htmlspecialchars($date) ?></td>
                    <td><?= htmlspecialchars($avgTemp) ?>°C</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

