<h4 class="filetitle">Overview</h4>
<p>
    This file (<span class="codeline">sys/classes/photos.php</span>) is included/required by the <a href="documentation.php?path=sys/core.php">sys/core.php</a> file.
</p>

<h4 class="filetitle">Requirements</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><a href="documentation.php?path=sys/core.php">sys/core.php</a></td>
            <td>Used to initialise all classes, PDO database and configuration</td>
        </tr>
        <tr>
            <td style="width: 25%;"><a target="_blank" href="http://github.com/dancoulter/phpflickr">sys/classes/phpFlickr/phpFlickr.php</a></td>
            <td>A 3rd Party Flickr API Wrapper</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Variables</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">$tags</span> : <em>string</em></td>
            <td>This variable holds the tag data, either randomly generated or user specified.<pre><code class="php">// Generate Tags to use if the user does not specify any tags
$tags = generateRandomTags();
if(isset($_REQUEST['tags']) &amp;&amp; $_REQUEST['tags'] != &quot;&quot;) 
    // Use the tags provided by the user
    $tags = $_REQUEST['tags'];</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$image_count</span> : <em>int</em></td>
            <td>This variable holds the loading photo count, either set to 20 or user specified.<pre><code class="php">// Set the image count to the user specified value, otherwise 20 if no input from user
$image_count = isset($_REQUEST['photoAmount']) ? $_REQUEST['photoAmount'] : 20;

// Validate the image count can be an integer
$image_count = ctype_digit($image_count) ? $image_count : 20;

// Validate the image count is a valid count
$image_count = ($image_count &gt;= 5 &amp;&amp; $image_count &lt;= 50) ? $image_count : 20;
	</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$radius</span> : <em>int</em></td>
            <td>This variable holds the radius in kilometres to search for from the latitude and longitude specified in the Flickr request.</td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$extras</span> : <em>string</em></td>
            <td>This variable holds the extras parameters for the Flickr request.</td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$perpage</span> : <em>int</em></td>
            <td>This variable holds the count of images to retrieve from the Flickr request.</td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">$sort</span> : <em>string</em></td>
            <td>This variable holds the sorting method for the Flickr request.</td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Functions</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;"><span class="codeline">getPhotoResults($city, $flickr, $tags, $radius, $perpage, $sort, $extras)</span><br/><br/><small>$city : <em>array</em><br/>$flickr : <em>Flickr Class</em><br/>$tags : <em>string</em><br/>$radius : <em>int</em><br/>$perpage : <em>int</em><br/>$sort : <em>string</em><br/>$extras : <em>string</em></small></td>
            <td>Searches for photos based on city and defined parameters<pre><code class="php">return $flickr->photos_search(array("tags" => $tags, "tag_mode" => "any", "lat" => $city['lat'], "lon" => $city['long'],
"radius" => $radius, "per_page" => $perpage, "sort" => $sort, "extras" => $extras));</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">constructPhotos($results, $flickr, $woeid, $count = 20)</span><br/><br/><small>$results : <em>array</em><br/>$flickr : <em>Flickr Class</em><br/>$woeid : <em>int</em><br/>$count : <em>int</em></small></td>
            <td>Constructs url of photos to be displayed on webpage<pre><code class="php">$photo_results = array();
$photo_results['woeid'] = $woeid;

$user_ids = array();

for ($i=0; $i &lt; $count; $i++) {
    // iterate through photo results
    // populate $photo_results array
}
return $photo_results;</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">clearPhotoCache()</span></td>
            <td>Cleares current cache of images<pre><code class="php">$statement = $db-&gt;prepare(&quot;TRUNCATE TABLE `images`&quot;);
$statement-&gt;execute();</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">cachePhotos($photosToCache, $count = 20)</span><br/><br/><small>$photosToCache : <em>array</em><br/>$count : <em>int</em></small></td>
            <td>Caches all photos in the array passes through as a parameter, useful because pulling various information using the Flickr API is quite time intensive.<pre><code class="php">for($i = 0; $i &lt; $count; $i++) {
    try {
        $statement = $db-&gt;prepare(&quot;INSERT INTO `images` (`img_id`, `title`, `desc`, `source`, `user_url`,
        `date_taken`, `lat`, `long`, `city_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)&quot;);
        //...bind parameters
        $statement-&gt;execute();
    } catch(Exception $e) {
        echo 'Error inserting images into database: ' . $e; 
    }
}</pre></code></td>
        </tr>
        <tr>
            <td style="width: 25%;"><span class="codeline">generateRandomTags()</span><br/><br/></td>
            <td>Generates random tags for the flickr search from a small pool of tags<pre><code class="php">$random_tags = array(...);
$randTags = &quot;&quot;;

for ($i=0; $i &lt; 5; $i++) { 
    $randTags = $randTags .$random_tags[rand(0,count($random_tags)-1)] . &quot;,&quot;;
}
    
return $randTags;</pre></code></td>
        </tr>
    </table>
</p>

<h4 class="filetitle">Example Usage of Code</h4>
<p>
    <table>
        <tr>
            <td style="width: 25%;">Clear Cache and Generate New Photos</td>
            <td>The following snippet of code is used to clear the cache, request more photos and then cache it back to the database.<pre><code class="php">// Clear the photos stored in the database
clearPhotoCache();

// -&gt; Photos for city one
$results = getPhotoResults($cities['city_one'],$flickr,$tags,$radius,$perpage,$sort,$extras);
$city_photos_one = constructPhotos($results, $flickr, $cities['city_one']['woeid'], $image_count);
cachePhotos($city_photos_one, $image_count);

// -&gt; Photos for city two
$results = getPhotoResults($cities['city_two'],$flickr,$tags,$radius,$perpage,$sort,$extras);
$city_photos_two = constructPhotos($results, $flickr, $cities['city_two']['woeid'], $image_count);
cachePhotos($city_photos_two, $image_count);</pre></code></td>
        </tr>
    </table>
</p>