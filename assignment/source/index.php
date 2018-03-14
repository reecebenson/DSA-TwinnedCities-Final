<?php
	// Website URL for the DSA Assignment
	$www = "http://www.cems.uwe.ac.uk/~r2-benson/dsa/assignment";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Source Files - Group 5</title>
		<style>
			body {
				margin: 0;
				padding: 0;
				background-color: #CCC;
				font-family: Verdana;
			}

			.content {
				width: 80%;
				margin: 0 auto;
				min-height: 300px;
				background-color: #FFF;
				border-bottom-left-radius: 5px;
				border-bottom-right-radius: 5px;
			}

			.title {
				width: 100%;
				text-align: center;
				padding: 25px;
				font-weight: bold;
				font-size: 22px;
			}

			#report {
				padding: 15px;
			}

			.directory {
				font-weight: bold;
			}

			a {
				text-decoration: none;
			}

			a:hover {
				text-decoration: underline;
			}
		</style>
	</head>
	<body>
		<div class="content">
			<div class="title">Source Files - Group 5</div>
			<div id="report">
				<ul>
					<li><em>Root Directory</em>
						<ul>
							<li><span class="directory">data/</span>
								<ul>
									<li><a target="_blank" href="<?=$www;?>/data/fetchInfo.phps">fetchInfo.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/data/fetchPointsOfInterest.phps">fetchPointsOfInterest.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/data/fetchWeather.phps">fetchWeather.php</a></li>
								</ul>
							</li>
							<li><span class="directory">gallery/</span>
								<ul>
									<li><span class="directory">css/</span>
										<ul>
											<li><a target="_blank" href="<?=$www;?>/gallery/css/index.css">index.css</a></li>
											<li><a target="_blank" href="<?=$www;?>/gallery/css/main.css">main.css</a></li>
										</ul>
									</li>
									<li><span class="directory">img/</span>
										<ul>
											<li><a target="_blank" href="<?=$www;?>/gallery/img/load.gif">load.gif</a></li>
											<li><a target="_blank" href="<?=$www;?>/gallery/img/header.jpg">header.jpg</a></li>
										</ul>
									</li>
									<li><span class="directory">js/</span>
										<ul>
											<li><a target="_blank" href="<?=$www;?>/gallery/js/main.js">main.js</a></li>
											<li><a target="_blank" href="<?=$www;?>/gallery/js/moment.timezone.js">moment.timezone.js</a></li>
										</ul>
									</li>
								</ul>
							</li>
							<li><span class="directory">pages/</span>
								<ul>
									<li><a target="_blank" href="<?=$www;?>/pages/flickr.phps">flickr.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/footer.phps">footer.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/header.phps">header.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/main.phps">main.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/poi.phps">poi.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/scripts.phps">scripts.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/singlepoi.phps">singlepoi.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/pages/twitter.phps">twitter.php</a></li>
								</ul>
							</li>
							<li><span class="directory">sys/</span>
								<ul>
									<li><span class="directory">classes/</span>
										<ul>
											<li><span class="directory">phpFlickr/</span>
												<ul>
													<li><a target="_blank" href="<?=$www;?>/sys/classes/phpFlickr/auth.phps">auth.php</a></li>
													<li><a target="_blank" href="<?=$www;?>/sys/classes/phpFlickr/getToken.phps">getToken.php</a></li>
													<li><a target="_blank" href="<?=$www;?>/sys/classes/phpFlickr/phpFlickr.phps">phpFlickr.php</a></li>
												</ul>
											</li>
											<li><a target="_blank" href="<?=$www;?>/sys/classes/photos.phps">photos.php</a></li>
											<li><a target="_blank" href="<?=$www;?>/sys/classes/places.phps">places.php</a></li>
											<li><a target="_blank" href="<?=$www;?>/sys/classes/site.phps">site.php</a></li>
											<li><a target="_blank" href="<?=$www;?>/sys/classes/twitter.phps">twitter.php</a></li>
										</ul>
									</li>
									<li><a target="_blank" href="<?=$www;?>/sys/configuration.phps">configuration.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/sys/core.phps">core.php</a></li>
									<li><a target="_blank" href="<?=$www;?>/sys/rss.phps">rss.php</a></li>
								</ul>
							</li>
							<li><a target="_blank" href="<?=$www;?>/.htaccess.s">.htaccess</a></li>
							<li><a target="_blank" href="<?=$www;?>/index.phps">index.php</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</body>
</html>