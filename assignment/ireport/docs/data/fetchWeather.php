yay<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">data/fetchWeather.php</span>) is a page that is called via Ajax Requests. This page takes <span class="codeline">$_REQUEST</span> parameters,
    processes the request and responds with data related to the data specified.
    <br/><br/>
    This page also deals with the Weather Caching features of the site. If there has not been a request within the past 60 minutes from any users, it will pull a fresh
    lot of data from the Open Weather Map API, using the <a href="documentation.php?path=sys/classes/places.php">Places</a> class. It will then store the data it pulls
    back into the database and updated the <span class="codeline">last_weather_pull_$woeid</span> row within the database table <span class="codeline">system_information</span>.
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/core.php">sys/core.php</a></td>
            <td>Used to initialise all classes, PDO database and configuration</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$response</span> : <em>array</em></td>
            <td>The array variable that will be printed as JSON.<pre><code class="php">$response = array(...);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$woeid</span> : <em>int</em></td>
            <td>The variable that holds the WOEID.<pre><code class="php">$woeid = $_POST['woeid'];</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$latitude</span> : <em>float</em></td>
            <td>The variable that holds the latitude value.<pre><code class="php">$latitude = $_POST['latitude'];</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$longitude</span> : <em>float</em></td>
            <td>The variable that holds the longitude value.<pre><code class="php">$longitude = $_POST['longitude'];</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$city</span> : <em>array</em></td>
            <td>The variable that holds data about the specified city, referenced by <span class="codeline">$woeid</span><pre><code class="php">$city = $site-&gt;getCityData($woeid);</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Source Code</h4>
<p>
    <table>
        <tr>
            <td><pre><code>/**
 * Requirements
 */
require_once('../sys/core.php');

/**
 * Variables
 */
$response = array('status' =&gt; 200, 'error' =&gt; null);
$woeid = $_POST['woeid'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$city = $site-&gt;getCityData($woeid);

/**
 * Check for errors
 */
if(!isset($_POST)) {
    $response['status'] = 500;
    $response['error'] = &quot;No data was sent in the request parameters.&quot;;
}

/**
 * Find our previous Weather Log - finished
 */
$weather = null;
$response['last_pull'] = $site-&gt;getSystemInfo(&quot;last_weather_pull_&quot;.$woeid);
if((time() - (int)$response['last_pull']) &gt; 3600) {
    // Pull new weather data
    $weather = Places::queryPlaceWeather($latitude, $longitude);

    // Reset timer
    $site-&gt;setSystemInfo(&quot;last_weather_pull_&quot;.$woeid, time());

    // Update stored weather data
    $weather['woeid'] = $woeid;
    $site-&gt;storeWeatherData($weather);
} else {
    // Pull old data
    $weather = $site-&gt;getStoredWeatherData($woeid);
    $weather['pull_time'] = (time() - (int)$response['last_pull']);
}

/**
 * Set our timeago string
 */
$response['timeago'] = $site-&gt;timeago((int)$site-&gt;getSystemInfo(&quot;last_weather_pull_&quot;.$woeid));

/**
 * Fix for 'degree' in weather response
 */
if(!isset($weather['wind']['deg']))
    $weather['wind']['deg'] = &quot;&lt;em&gt;unknown&lt;/em&gt;&quot;;

/**
 * Set our dates for sunrise/sunset
 */
// Set Timezone to requested city
$defaultTimezone = date_default_timezone_get();
date_default_timezone_set($city['timezone']);

// Update Variables
$weather['sunrise'] =  date(&quot;H:i:sa&quot;, $weather['sys']['sunrise']);
$weather['sunset'] =  date(&quot;H:i:sa&quot;, $weather['sys']['sunset']);

// Reset Timezone back to default
date_default_timezone_set($defaultTimezone);

/**
 * Data to send back
 */
$response['weather'] = $weather;

/**
 * Output
 */
die(json_encode($response, JSON_PRETTY_PRINT));</code></pre></td>
        </tr>
    </table>
</p>