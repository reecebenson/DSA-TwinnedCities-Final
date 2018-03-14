<?php
	/**
	 * Weather Forecast
	 *
	 * PHP version 5.6.30
	 *
	 * @author   Reece Benson, Lewis Cummins, Devon Davies, Daisy
	 * @license  MIT License
	 * @link     http://github.com/reecebenson/dsa-twinnedcities/
	 */

	/**
	 * Requirements
	 */
	require_once('../sys/core.php');

	/**
	 * Check if we have been passed our data
	 */
	if(!isset($_REQUEST['woeid']))
		die('Unable to load data. Not all requested data was received.');

	/**
	 * Get our city data from WOE ID
	 */
	$city = $site->getCityData($_REQUEST['woeid']);

	/**
	 * Check we have a valid city
	 */
	if($city == null)
        die('Specified WOE ID (' . $_REQUEST['woeid'] . ') does not exist.');
        
    /** 
     * Get our Forecast
     */
    $forecast = Places::queryPlaceForecast($city['lat'], $city['long']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Forecast for <?=$city['name'];?></title>

        <style type="text/css">
            body {
                background-color: #EEE;
                font-family: "Verdana";
                font-size: 13px;
                text-align: center;
            }

            thead {
                font-weight: bold;
            }

            td {
                padding: 2px;
                border: 1px solid #CCC;
            }
        </style>
    </head>
    <body>
        <table style="width: 100%; height: 100%;">
            <thead>
                <tr>
                    <td></td>
                    <td>Time &amp; Date</td>
                    <td>Condition</td>
                    <td>Wind</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($forecast['list'] as $f) {
                        // Deconstruct Data
                        $tempCurrent = floor($f['main']['temp'] - 273.15);
                        $tempMin = floor($f['main']['temp_min'] - 273.15);
                        $tempMax = floor($f['main']['temp_max'] - 273.15);

                        // Data
                        $img = "<img src='http://openweathermap.org/img/w/" . $f['weather'][0]['icon'] . ".png' alt='" . $f['weather'][0]['icon'] . "'>";
                        $dt = date(" h:ia, D jS \of F", $f['dt']);
                        $type = "<strong>" . ucwords($f['weather'][0]['description']) . "</strong> <small>(" . $f['clouds']['all'] . "% clouds)</small>";
                        $condition = $tempCurrent . "&#8451;, from " . $tempMin . "&#8451; to " . $tempMin . "&#8451;";
                        $wind = "Wind: " . $f['wind']['speed'] . "m/s, " . floor($f['wind']['deg']) . "&deg; (" . Places::getCompassFromDegree($f['wind']['deg']) . ")";

                        // Echo Forecast
                        echo "<tr>";
                        echo "<td>" . $img . "</td>";
                        echo "<td>" . $dt . "</td>";
                        echo "<td>" . $type . "<br/>" . $condition . "</td>";
                        echo "<td>" . $wind . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </body>
</html>