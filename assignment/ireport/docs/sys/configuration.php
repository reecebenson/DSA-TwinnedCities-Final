<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">sys/configuration.php</span>) reads in the <a href="documentation.php?path=sys/configuration.xml.php">XML file</a> and parses it to
    PHP arrays. These variables can be called/referenced on any files that includes either this file or <a href="documentation.php?path=sys/core.php">sys/core.php</a>.
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td>None</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$db_type</span> : <em>string</em></td>
            <td>This variable defines what type of connection details we'll be using, either &quot;live&quot; or &quot;dev&quot;.<pre><code class="php">$db_type = &quot;live&quot;;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$configData</span> : <em><a target="_blank" href="http://php.net/manual/en/book.simplexml.php">SimpleXMLElement</a></em></td>
            <td>The SimpleXMLElement that contains the configuration data.<pre><code class="php">$configData = simplexml_load_file(__DIR__.&quot;/configuration.xml&quot;);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$db_details</span> : <em>array</em></td>
            <td>A PHP Array that holds the database configuration data (specified by <span class="codeline">$db_type</span>).<pre><code class="php">$db_details = array(
    'user' =&gt; $configData-&gt;database-&gt;$db_type-&gt;username,    // Holds the username of the database account
    'pass' =&gt; $configData-&gt;database-&gt;$db_type-&gt;password,    // Holds the password of the database account
    'host' =&gt; $configData-&gt;database-&gt;$db_type-&gt;host,        // Holds the host of the database
    'name' =&gt; $configData-&gt;database-&gt;$db_type-&gt;name         // Holds the table of what PDO should connect to
);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$gm_details</span> : <em>array</em></td>
            <td>A PHP Array that holds the Google Maps API data.<pre><code class="php">$gm_details = array(
    'key' =&gt; $configData-&gt;googlemaps-&gt;key  // Google Maps API Key
);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$tw_details</span> : <em>array</em></td>
            <td>A PHP Array that holds the Twitter API data.<pre><code class="php">$tw_details = array(
    'oauth_access_token' =&gt; $configData-&gt;twitter-&gt;oauth_access_token,                  // Twitter Access Token
    'oauth_access_token_secret' =&gt; $configData-&gt;twitter-&gt;oauth_access_token_secret,    // Twitter Access Token (Secret)
    'consumer_key' =&gt; $configData-&gt;twitter-&gt;consumer_key,                              // Twitter Consumer Key
    'consumer_secret' =&gt; $configData-&gt;twitter-&gt;consumer_secret                         // Twitter Consumer Secret
);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$fl_details</span> : <em>array</em></td>
            <td>A PHP Array that holds the Flickr API data.<pre><code class="php">$fl_details = array(
    'key' =&gt; $configData-&gt;flickr-&gt;key, // Flickr Access Key
    'id' =&gt; $configData-&gt;flickr-&gt;id    // Flickr Access Identifier
);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$owm_details</span> : <em>array</em></td>
            <td>A PHP Array that holds the Open Weather Map API data.<pre><code class="php">$owm_details = array(
		'key' =&gt; $configData-&gt;openweathermap-&gt;key,             // Open Weather Map Key
		'api_base' =&gt; $configData-&gt;openweathermap-&gt;api_base    // Open Weather Map URL Base
	);</pre></code></td>
        </tr>
    </table>
</p>