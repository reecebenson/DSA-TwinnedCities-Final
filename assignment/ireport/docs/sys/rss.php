<h4 class="filetitle">Overview</h4>
<p>
    This page (<span class="codeline">sys/rss.php</span>) generates a RSS feed of the dataset held in the database. 
    The data shows all current data regarding our cities and places of interest currently held in the database.
    <br/><br/>
    The header type of this file is set to XML through the following line of code:
    <pre><code>header(&quot;Content-Type: application/xml&quot;);</pre></code>
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

<h4 class="filetitle">Used Methods</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/site.php">sys/classes/site.php</a></td>
            <td>Grabs the stored weather data from the database.<pre><code class="php">$site->getStoredWeatherData(int $woeId);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/site.php">sys/classes/site.php</a></td>
            <td>Gets the city data from the database.<pre><code class="php">$site->getCityData(int $woeid);</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$channel</span> : <em>string</em></td>
            <td>This variable holds the data that will build the XML/RSS Feed.<pre><code class="php">$channel = ...;</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Usage of Code</h4>
<p>
    <pre><code>&lt;?xml version=&quot;1.0&quot;?&gt;
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;?=$channel;?&gt;
&lt;/rss&gt;</code></pre>
</p>

<h4 class="filetitle">Example Result</h4>
<p>
    <pre><code>&lt;?xml version=&quot;1.0&quot; encoding=&quot;UTF-8&quot;?&gt;
&lt;rss version=&quot;2.0&quot;&gt;
    &lt;channel&gt;
        &lt;title&gt;Twinned Cities - Manchester and Los Angeles&lt;/title&gt;
        &lt;link&gt;http://uwe.reecebenson.me/dsa-twincities-final&lt;/link&gt;
        &lt;description /&gt;
        &lt;language&gt;en-gb&lt;/language&gt;
        &lt;lastBuildDate&gt;14-Mar-2018 22:02:51pm Europe/London&lt;/lastBuildDate&gt;
        &lt;item&gt;
            &lt;title&gt;Weather for Manchester&lt;/title&gt;
            &lt;link&gt;http://uwe.reecebenson.me/dsa-twincities-final&lt;/link&gt;
            &lt;description&gt;The current weather is classed as broken clouds. Currently 8℃, from 5℃ to 10℃. Wind: 5.1m/s, 120°. Sunrise: 06:24:05am, Sunset: 18:12:43pm&lt;/description&gt;
        &lt;/item&gt;
        &lt;item&gt;
            &lt;title&gt;Weather for Los Angeles&lt;/title&gt;
            &lt;link&gt;http://uwe.reecebenson.me/dsa-twincities-final&lt;/link&gt;
            &lt;description&gt;The current weather is classed as overcast clouds. Currently 15℃, from 12℃ to 17℃. Wind: 1.5m/s, 0°. Sunrise: 07:03:32am, Sunset: 19:00:38pm&lt;/description&gt;
        &lt;/item&gt;
    &lt;/channel&gt;
&lt;/rss&gt;</code></pre>
</p>