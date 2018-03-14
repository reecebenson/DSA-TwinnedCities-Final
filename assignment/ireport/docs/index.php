<h4 class="filetitle">Overview</h4>
<p>
    This page (<span class="codeline">index.php</span>) is the main page of this website, all webpages linked from this page are externally called via using jQuery's Ajax
    functionality. This allows the clients computer to process the information and not have to cycle through different webpages, this way we only grab the content that
    the user wants to display. Most of the data is processed through JavaScript/jQuery methods so that we don't have to do much backend work.
    <br/><br/>
    For example, all of the city data (on load) is processed into JavaScript variables and we chose to make them load within this page so that all other pages that
    are loaded from then on, have access to these variables (as all other webpages will be within the scope of the <span class="codeline">index.php</span> webpage).
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/core.php">sys/core.php</a></td>
            <td>Used to initialise all classes, PDO database and configuration</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=pages/header.php">pages/header.php</a></td>
            <td>Includes CSS Stylesheets required for each page</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=pages/scripts.php">pages/scripts.php</a></td>
            <td>Includes JavaScript files required for each page</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Used Methods</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/site.php">sys/classes/site.php</a></td>
            <td>Grab some information out of the <span class="codeline">$sys_info</span> variable<pre><code class="php">$site->getSystemInfo(string $name);</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/classes/site.php">sys/classes/site.php</a></td>
            <td>Get the city data from the database specified by <span class="codeline">$woeid</span><pre><code class="php">$site->getCityData(int $woeId);</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/core.php">sys/core.php</a></td>
            <td>Global variable that refers to the host domain by using <span class="codeline">$www</span><pre><code class="php">(string)$www;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/core.php">sys/core.php</a></td>
            <td>The <span class="codeline">$cities</span> variable holds standard data about our chosen cities<pre><code class="php">(array)$cities;</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Examples of Usage of Code</h4>
<p>
    <table>
        <tr>
            <td><pre><code>$site->getCityData($cities['city_one']['woeid']);</code></pre></td>
        </tr>
        <tr>
            <td><pre><code>&lt;a href="&lt;?=$www;?&gt;"&gt;&lt;?=$site-&gt;getSystemInfo("authors");?&gt;&lt;/a&gt;</code></pre></td>
        </tr>
        <tr>
            <td><pre><code>&lt;?php require_once('pages/header.php'); ?&gt;</code></pre></td>
        </tr>
    </table>
</p>