<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">data/fetchInfo.php</span>) is a page that is called via Ajax Requests. This page takes <span class="codeline">$_REQUEST</span> parameters,
    processes the request and responds with data related to the data specified.
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
            <td>The variable that holds the WOEID.<pre><code class="php">$woeid = $_REQUEST['woeid'];</pre></code></td>
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

/**
 * Check for errors
 */
if(!isset($_POST)) {
    $response['status'] = 500;
    $response['error'] = &quot;No data was sent in the request parameters.&quot;;
}

/**
 * Get city data
 */
$response['city'] = $site-&gt;getCityData($woeid);

/**
 * Output
 */
die(json_encode($response, JSON_PRETTY_PRINT));</code></pre></td>
        </tr>
    </table>
</p>