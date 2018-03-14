<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">sys/classes/places.php</span>) is included/required by the <a href="documentation.php?path=sys/core.php">sys/core.php</a> file.
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td>None</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Static Class Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$openWeatherMap</span> : <em>string</em> <small>(public)</small></td>
            <td>This variable holds the Open Weather Map Base URL.<pre><code class="php">public static $openWeatherMap = null;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$openWeatherMapKey</span> : <em>string</em> <small>(public)</small></td>
            <td>This variable holds the Open Weather Map API Key.<pre><code class="php">public static $openWeatherMapKey = null;</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Static Class Functions</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">queryOpenWeatherMap($apiType, $args)</span><br/><br/><small>$apiType : <em>string</em><br/>$args : <em>array</em></small></td>
            <td>This method is used to get the response from the Open Weather Map API.<pre><code class="php">$qryUrl = self::$openWeatherMap . &quot;/&quot; . $apiType . &quot;?APPID=&quot; . self::$openWeatherMapKey . &quot;&amp;&quot; . $args;
$data = json_decode(file_get_contents($qryUrl), true);
return $data;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">queryPlaceWeather($lat, $long)</span><br/><br/><small>$lat : <em>float</em><br/>$long : <em>float</em></small></td>
            <td>Send a API request that retrieves the weather data from OpenWeatherMap from the Latitude and Longitude of a location.<pre><code class="php">$args = array(
    &quot;lat&quot; =&gt; $lat,
    &quot;lon&quot; =&gt; $long
);
return self::queryOpenWeatherMap(&quot;weather&quot;, http_build_query($args));</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">queryPlaceWeather($lat, $long)</span><br/><br/><small>$lat : <em>float</em><br/>$long : <em>float</em></small></td>
            <td>Send a API request that retrieves the forecast data from OpenWeatherMap from the Latitude and Longitude of a location.<pre><code class="php">$args = array(
    &quot;lat&quot; =&gt; $lat,
    &quot;lon&quot; =&gt; $long
);
return self::queryOpenWeatherMap(&quot;forecast&quot;, http_build_query($args));</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">getCompassFromDegree($d)</span><br/><br/><small>$d : <em>int</em></small></td>
            <td>Convert degrees into the compass format<pre><code class="php">$dirs = array('↑ N', '↗ NE', '→ E', '↘ SE', '↓ S', '↙ SW', '← W', '↖ NW', '↑ N'); 
return $dirs[round($d/45)];</pre></code></td>
        </tr>
    </table>
</p>