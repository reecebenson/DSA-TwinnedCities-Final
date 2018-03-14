<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">data/fetchPointsOfInterest.php</span>) is a page that is called via Ajax Requests. This page takes <span class="codeline">$_REQUEST</span> parameters,
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
$woeid = $_REQUEST['woeid'];

/**
 * Check for errors
 */
if(!isset($_REQUEST) || !isset($_REQUEST['woeid']) || !isset($_REQUEST['type'])) {
    $response['status'] = 500;
    $response['error'] = &quot;No data was sent in the request parameters.&quot;;
}

/**
 * Get our city data from WOE ID
 */
$city = $site-&gt;getCityData($_REQUEST['woeid']);

/**
 * Check we have a valid city
 */
if($city == null) {
    $response['status'] = 500;
    $respnose['error'] = &quot;The inputted Woe ID was invalid.&quot;;
} else {
    /**
     * Setup response specific to type request
     */
    switch($_REQUEST['type']) {
        default:
        case &quot;list&quot;: {
            /**
             * Build content
             */
            $builtList = &quot;&quot;;
            $id = 0;
            foreach($city['poi'] as $name =&gt; $data) {
                $builtList .= &quot;&lt;div class='row' style='padding-top: 2px;'&gt;&quot;;
                $builtList .= &quot;&lt;div class='col'&gt;&lt;img alt='&quot; . $name . &quot;' src='&quot; . $data['image'] . &quot;' style='border-radius: 8px; width: 16px; height: 16px;'&gt;&quot;;
                $builtList .= &quot;&lt;a href='#map' onclick='selectPoint(&quot; . $id . &quot;);'&gt;&lt;span style='padding-left: 8px; vertical-align: middle;'&gt;&quot;;
                $builtList .= $data['name'] . &quot;&lt;/span&gt;&lt;/a&gt;&lt;/div&gt;&lt;/div&gt;&quot;;
                $id++;
            }
            $response['text'] = $builtList;
        }
        break;

        case &quot;map&quot;: {
                /**
                 * We only want the Point of Interest information sent back
                 */
                die(json_encode($city['poi'], JSON_PRETTY_PRINT));
            }
            break;
    }
}

/**
 * Output
 */
die(json_encode($response, JSON_PRETTY_PRINT));</code></pre></td>
        </tr>
    </table>
</p>