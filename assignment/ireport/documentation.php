<?php
	/**
	 * Homepage
	 *
	 * PHP version 5.6.30
	 *
	 * @author   Reece Benson
	 * @license  MIT License
	 * @link     http://github.com/reecebenson/dsa-twinnedcities/
	 */

	/**
	 * Check if we have a file to show
	 */
	$file = null;
	$path = null;
	$selectedItem = false;
	if(isset($_GET['path'])) {
		// Flags
		$selectedItem = true;
		$path = $_GET['path'];

		// Check File Exists
		if(file_exists("docs/".$path))
			$file = file_get_contents("docs/" . $path);
		else
			$file = "The requested file does not exist: <strong>" . $path . "</strong>, please select another item or try again.";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Documentation - Reece Benson (16021424)</title>
		<link rel="stylesheet" href="styles/docs.css" type="text/css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/default.min.css">
	</head>
	<body>
		<div class="header">
			<div class="title">Individual Task - Reece Benson (16021424)<br/><small>Documentation</small></div>
		</div>
		<div class="nav">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="documentation.php">Documentation</a></li>
				<?=($selectedItem ? "<li style='float:right;'>" . $path . "</li>" : "");?>
			</ul>
		</div>
		<div class="content">
			<div id="file_content">
				<div id="file_pane">
					<ul>
						<li><em>Root Directory</em>
							<ul>
								<li><span class="directory">data/</span>
									<ul>
										<li><a href="documentation.php?path=data/fetchInfo.php">fetchInfo.php</a></li>
										<li><a href="documentation.php?path=data/fetchPointsOfInterest.php">fetchPointsOfInterest.php</a></li>
										<li><a href="documentation.php?path=data/fetchWeather.php">fetchWeather.php</a></li>
									</ul>
								</li>
								<li><span class="directory">pages/</span>
									<ul>
										<li><a href="documentation.php?path=pages/flickr.php">flickr.php</a></li>
										<li><a href="documentation.php?path=pages/footer.php">footer.php</a></li>
										<li><a href="documentation.php?path=pages/header.php">header.php</a></li>
										<li><a href="documentation.php?path=pages/main.php">main.php</a></li>
										<li><a href="documentation.php?path=pages/poi.php">poi.php</a></li>
										<li><a href="documentation.php?path=pages/scripts.php">scripts.php</a></li>
										<li><a href="documentation.php?path=pages/singlepoi.php">singlepoi.php</a></li>
										<li><a href="documentation.php?path=pages/twitter.php">twitter.php</a></li>
									</ul>
								</li>
								<li><span class="directory">sys/</span>
									<ul>
										<li><span class="directory">classes/</span>
											<ul>
												<li><a href="documentation.php?path=sys/classes/photos.php">photos.php</a></li>
												<li><a href="documentation.php?path=sys/classes/places.php">places.php</a></li>
												<li><a href="documentation.php?path=sys/classes/site.php">site.php</a></li>
												<li><a target="_blank" href="https://github.com/j7mbo/twitter-api-php">twitter.php</a></li>
											</ul>
										</li>
										<li><a href="documentation.php?path=sys/configuration.php">configuration.php</a></li>
										<li><a href="documentation.php?path=sys/core.php">core.php</a></li>
										<li><a href="documentation.php?path=sys/rss.php">rss.php</a></li>
									</ul>
								</li>
								<li><a href="documentation.php?path=index.php">index.php</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<div id="file_data">
					<?php if(!$selectedItem) { ?>
					<p>
						Please select an item on the left side to view details about that file, each file will show you how it links from one another, 
						the use of functions, the configuration files (php/xml) and how it interacts with the database.<br/>
						<small><em>It seems writing your own documentation template gives you a whole lot more to write about.</em></small>
					</p>
					<hr/>
					<p>
						When clicking onto the documented files you'll see "code blocks" like the following, these are snippets of code found within the source files. I've used a jQuery Plugin called <a href="https://highlightjs.org/">highlight.js</a> in order to highlight the syntax.
						<pre><code>$db = null;
try {
	$db = new PDO("mysql:dbname=" . $db_details['name'] . ";host=" . $db_details['host'], $db_details['user'], $db_details['pass']);
} catch(PDOException $e) {
	die('Error connecting to database: ' . $e->getMessage());
}</code></pre>
					</p>
					<?php } else { echo $file; } ?>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
		<script>hljs.initHighlightingOnLoad();</script>
	</body>
</html>