<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">sys/core.php</span>) is a page that is used globally on all public files, this means that wherever a user has
    access to, this page is more than likely included/required. Having a "core" file makes it easier to manage classes, sessions, database initialisations,
    global variables and more.
    <br/><br/>
    In this file, it includes all of the other classes required for the site to function (site.php, places.php, twitter.php and configuration.php).
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/configuration.php">sys/configuration.php</a></td>
            <td>Holds all of the configuration data</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/site.php">sys/classes/site.php</a></td>
            <td>Site Class</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/places.php">sys/classes/places.php</a></td>
            <td>Places Class</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a target="_blank" href="https://github.com/j7mbo/twitter-api-php">sys/classes/twitter.php</a></td>
            <td>A 3rd Party Twitter API Wrapper</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$db</span> : <em><a target="_blank" href="http://php.net/manual/en/book.pdo.php">PDO</a></em></td>
            <td>Global variable that initialises and connects to the database through the PDO class.<pre><code class="php">$db = new PDO(...);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$www</span> : <em>string</em></td>
            <td>Global variable that refers to the host domain by using <span class="codeline">$www</span><pre><code class="php">$www = "path/to/site";</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$cities</span> : <em>array</em></td>
            <td>The <span class="codeline">$cities</span> variable holds standard data about our chosen cities<pre><code class="php">$cities = array(...);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$site</span> : <em><a href="documentation.php?path=sys/classes/site.php">Site</a></em></td>
            <td>The <span class="codeline">$site</span> references the Site class and makes a new instance of it.<pre><code class="php">$site = new Site();</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Examples of Usage of Code</h4>
<p>
    <table>
        <tr>
            <td><pre><code>$db = null;
try {
    $db = new PDO(&quot;mysql:dbname=&quot; . $db_details['name'] . &quot;;host=&quot; . $db_details['host'], $db_details['user'], $db_details['pass']);
} catch(PDOException $e) {
    die('Error connecting to database: ' . $e-&gt;getMessage());
}</code></pre></td>
        </tr>
        <tr>
            <td><pre><code>$www = &quot;http://uwe.reecebenson.me/dsa-twincities-final&quot;;</code></pre></td>
        </tr>
        <tr>
            <td><pre><code>$cities = array(
    &quot;city_one&quot; =&gt; $site-&gt;getCityData(&quot;28218&quot;),
    &quot;city_two&quot; =&gt; $site-&gt;getCityData(&quot;2442047&quot;)
);</code></pre></td>
        </tr>
    </table>
</p>