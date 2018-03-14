<?php
	/**
	 * Flickr
	 *
	 * PHP version 5.6.30
	 *
	 * @author   Reece Benson, Lewis Cummins, Devon Davies, Daisy
	 * @license  MIT License
	 * @link     http://github.com/reecebenson/dsa-twinnedcities/
	 */


	/**
	 * Requirements
	 */
	require_once('../sys/core.php');
	
	/**
	 * Check if we have been passed a Woe ID
	 */
	if(!isset($_REQUEST['woeid']))
		die('Unable to load data. WOE ID was not received.');



	/**
	 * Get our city data from WOE ID
	 */
	$woeid = $_REQUEST['woeid'];

	/**
	 * Classify Photo Arrays
	 */
	$photos[$cities['city_one']['woeid']] = getPhotosFromDB($cities['city_one']['woeid']);
	$photos[$cities['city_two']['woeid']] = getPhotosFromDB($cities['city_two']['woeid']);

	/**
	 * getPhotosFromDB
	 * 
	 * @param int $cityID WoeID for the specified city
	 */
	function getPhotosFromDB($cityID){

		global $db;

		$statement = $db->prepare("SELECT * FROM `images` WHERE `city_id` = ?");
		$statement->bindParam(1, $cityID);
		
		$statement->execute();

		$city_photos = $statement->fetchAll(PDO::FETCH_ASSOC);

		return $city_photos;

	}

	/**
	 * displayPhotos
	 * 
	 * @param array $photos The array of photos to display
	 * @param int   $woeid  WoeID for the specified city
	 */
	function displayPhotos($photos, $woeid){
		/**
		 * Loop through available photos
		 */
		if(empty($photos[$woeid])){
			echo("<h1>NO PHOTOS LOADED</h1>");
		} else {
			
			for($i = 0; $i < sizeof($photos[$woeid]); $i++) {
				// Get our photo
				$photo = $photos[$woeid][$i];
				
				// Display
				echo '<div class="carousel-item ' . ($i == 0?"active":"") .'">';
				echo '<img class="d-block w-100" src="' . $photo["source"] . '" alt="' . $photo["title"] . '">';
				echo '<div class="carousel-caption d-none d-md-block carousel-backdrop">';
				echo '<h5>' . $photo["title"] . ' </h5>';
				echo '<p>'. $photo["desc"] . '</p>';
				echo '<p>Date Taken: '. $photo['date_taken'] . '</p>';
				echo '<p><a target="_blank" href="' . $photo["user_url"] . '">View Photo on Flickr</a></p>';
				echo '</div>';
				echo '</div>';

			}
		}
	}
?>
<!-- Stylesheets for Flickr -->
<link href="<?=$www;?>/gallery/css/index.css" rel="stylesheet">
<link href="<?=$www;?>/gallery/css/flickr.css" rel="stylesheet">
<script type="text/javascript">
	function fetchNewPhotos() {
		/**
		 * Elements
		 */
		var flickrChangeContent = $('#flickr-options-container').html();
		var searchTags = document.getElementById("tags").value;
		var amountOfPhotos = $('#photo-amount').find(':selected').text();

		// Tags
		searchTags = searchTags.replace(/\s/g, '');

		/**
		 * Ajax Request
		 */
		$.ajax({
			method: 'POST',
			url: '<?=$www;?>/sys/classes/photos.php',
			data: {
				tags: searchTags,
				photoAmount: amountOfPhotos,
			},
			timeout: 300000000,
			cache: false,
			beforeSend: function() {
				$('#flickr-options').html("<div style='display:table-cell; vertical-align:middle; text-align:center'><table><tr><td><h2>Refreshing Photos</h2></td></tr><tr><td><img alt='Loading...' src='<?=$www;?>/gallery/img/load.gif'></td></tr</img></div>");
				console.log("Caching new photos");
			},
			error: () =>{
				console.log("Did not finish caching");
			},
			success: (result) =>{
				$('#flickr-options-container').html(flickrChangeContent);
				console.log("Complete");
				if(currentCity == null) return;
				executeCity(currentCity.woeid, currentCity.lat, currentCity.long, "flickr");
				currentPage = "flickr";
				removeActiveButtons();
			}
		});
	}
</script>
<div class="container" id="flickr-options-container">
    <div id="content" class="flickr-options">
		<div class="row" id="placeInfo">
			<div class="col">
				<div class="title" style="font-size: 20px">Flickr Options</div>
				<div class="content" id="flickr-options">
					<div class="col-3"></div>
					<div class="col-6">
						<select id="photo-amount" class="form-control"> 
							<option value="15" disabled selected>Choose amount of photos</option>
							<option value="5">5</option>
							<option value="10">10</option>
							<option value="25">25</option>
							<option value="50">50</option>
						</select>
						<br/>
						<div class="input-group">
							<input type="text" class="form-control" id="tags" placeholder="Enter tags followed by commas...">
							<span class="input-group-btn">
								<button id="update" type="button" class="btn btn-secondary button-update" onclick="fetchNewPhotos()">Load New Photos</button>
							</span>
						</div>
					</div>
					<div class="col-3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div id="carouselIndicator" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselIndicator" data-slide-to="0" class="active"></li>
			<?php for($i = 1; $i < sizeof($photos[$woeid]); $i++) { ?>
			<li data-target="#carouselIndicator" data-slide-to="<?=$i;?>"></li>
			<?php } ?>
		</ol>
		<div class="carousel-inner" id="photo-reel">
			<?php
				displayPhotos($photos, $woeid);
			?>
		</div>
		<a class="carousel-control-prev" href="#carouselIndicator" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselIndicator" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
</div>

