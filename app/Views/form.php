<form method="POST" action="">
    <!-- Section 1: Current Weather -->
    <fieldset>
        <legend>Current Weather</legend>
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
    </fieldset>

    <!-- Section 2: Historical Weather -->
    <fieldset>
        <legend>Historical Weather</legend>
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
    </fieldset>

    <!-- Section 3: Additional Features -->
    <fieldset>
        <legend>Additional Features</legend>
        <div>
            <strong>Get Other Parameters:</strong><br>
            <input type="checkbox" id="humidity" name="parameters[]" value="humidity">
            <label for="humidity">Humidity</label>
            <input type="checkbox" id="sunset" name="parameters[]" value="sunset">
            <label for="sunset">Sunset</label>
            <input type="checkbox" id="temperature" name="parameters[]" value="temperature">
            <label for="temperature">Temperature</label>
            <input type="checkbox" id="precipitation" name="parameters[]" value="precipitation">
            <label for="precipitation">Precipitation</label>
            <br>
            <button type="submit" name="action" value="get_other_parameters">Get Other Parameters</button>
        </div>
        <div>
            <button type="submit" name="action" value="get_airconditions">Get Air Conditions</button>
        </div>
        <div>
            <button type="submit" name="action" value="show_clickable_map">Show Clickable Map</button>
        </div>
    </fieldset>
</form>

<?php
echo '<pre>';
print_r($_POST);
echo '</pre>';
?>
