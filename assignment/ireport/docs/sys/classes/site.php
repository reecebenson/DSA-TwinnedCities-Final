<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">sys/classes/site.php</span>) is included/required by the <a href="documentation.php?path=sys/core.php">sys/core.php</a> file.
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td>None</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Class Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$sys_info</span> : <em>array</em> <small>(private)</small></td>
            <td>This variable holds the data from the <span class="codeline">system_information</span> table within the database.<pre><code class="php">private $sys_info; // Holds data from the `system_information` table as cache</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Class Functions</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">__construct()</span></td>
            <td>This method is called when the <span class="codeline">Site</span> class is instantiated. This simply calls a database query and caches the <span class="codeline">system_information</span> table.<pre><code class="php">// Store data to variable
foreach($db-&gt;query(&quot;SELECT `name`, `value` FROM `system_information`&quot;) as $res)
{
    $this-&gt;sys_info[$res['name']] = $res['value'];
}</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">getSystemInfo($name)</span> <small>(public)</small><br/><br/><small>$name : <em>string</em></small></td>
            <td>This method is used to retrieve data from the <span class="codeline">$sys_info</span> cache variable.<pre><code class="php">return $this->sys_info[$name];</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">setSystemInfo($name, $val)</span> <small>(public)</small><br/><br/><small>$name : <em>string</em><br/>$val : <em>string</em><small></td>
            <td>This method is used to set data in the <span class="codeline">system_information</span> table of the database, this also updates the <span class="codeline">$sys_info</span> cache variable.<pre><code class="php">// Update Database
$statement = $db-&gt;prepare(&quot;UPDATE `system_information` SET `value` = ? WHERE `name` = ? LIMIT 1&quot;);
$statement-&gt;bindParam(1, $val);
$statement-&gt;bindParam(2, $name);
$statement-&gt;execute();

// Set the value locally
$this-&gt;sys_info[$name] = $val;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">storeWeatherData($weatherData)</span> <small>(public)</small><br/><br/><small>$weatherData : <em>array</em></small></td>
            <td>This method is used to set data in the <span class="codeline">city_weather</span> table of the database.<pre><code class="php">$statement = $db-&gt;prepare(&quot;UPDATE `city_weather` SET `temp` = :temp, `temp_min` = :tempMin, `temp_max` = :tempMax,
`description` = :weatDesc, `icon` = :weatIcon, `cloud_percent` = :cloudPercent, `wind_speed` = :windSpeed, 
`wind_dir` = :windDir, `time_sunrise` = :sunRise, `time_sunset` = :sunSet WHERE `woeid` = :woeId LIMIT 1&quot;);
//...bind params of $statement
$statement->execute();</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">getStoredWeatherData($woeid)</span> <small>(public)</small><br/><br/><small>$woeid : <em>int</em></small></td>
            <td>This method is used to retrieve the data within <span class="codeline">city_weather</span> table of the database.<pre><code class="php">$statement = $db-&gt;prepare(&quot;SELECT * FROM `city_weather` WHERE `woeid` = ? LIMIT 1&quot;);
$row = $statement->fetch(PDO::FETCH_ASSOC);
$resp = array(...);
//...populate $resp array
return $resp;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">getCityData($woeid)</span> <small>(public)</small><br/><br/><small>$woeid : <em>int</em></small></td>
            <td>This method is used to retrieve the data within <span class="codeline">cities</span> table of the database.<pre><code class="php">$statement = $db-&gt;prepare(&quot;SELECT * FROM `city` WHERE `woeid` = ? LIMIT 1&quot;);
$row = $statement->fetch(PDO::FETCH_ASSOC);
//...add points of interest to $row data
return $row;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">getPointsOfInterest($woeid)</span> <small>(public)</small><br/><br/><small>$woeid : <em>int</em></small></td>
            <td>This method is used to retrieve the data within <span class="codeline">places</span> table of the database.<pre><code class="php">$poi = array();
$statement = $db-&gt;prepare(&quot;SELECT * FROM `places` WHERE `city_id` = ?&quot;);
$statement->execute();
foreach($statement->fetchAll() as $res)
{
    $place = array(...); // Data is from populated from $res data
    $poi[$res['name']] = $place; // Add place to POI array
}
return $poi;
</pre></code></td>
        </tr>
    </table>
</p>