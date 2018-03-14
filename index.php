<?php
	/**
	 * Homepage
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
	require_once('sys/core.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
		<title>Homepage | <?=$site->getSystemInfo("site_name_long");?></title>

        <!-- HEADER REQUIREMENT -->
        <?php require_once('pages/header.php'); ?>

        <!-- SLIDESHOW CSS -->
        <style>
            .slideshow { height: 560px; width: 530px; margin: auto }
            .slideshow img { padding: 7px; border-radius: 3px; border: 1px solid #ccc; background-color: #eee; }
        </style>
    </head>
    <body style="margin: 0 auto;">
        <div class="container">
            <div id="content-container">
                <div id="header">
                    <?=$cities['city_one']['name'];?> and <?=$cities['city_two']['name'];?>
                </div>
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto" id="navbarNav">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" id="btnHome"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btnPoi"><i class="fa fa-map-marker"></i> Points of Interest</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btnTwitter"><i class="fa fa-twitter"></i> Twitter</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="btnFlickr"><i class="fa fa-flickr"></i> Flickr</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="cityOneClick"><?=$cities['city_one']['name'];?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" id="cityTwoClick"><?=$cities['city_two']['name'];?></a>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div id="ajaxContent">
                    <div style="text-align: center; padding-top: 25px;">
                        <h3>Please select a city from the top right</h3>
                    </div>
                </div>
            </div>
            <div class="footer">
                Copyright <?=@date("Y");?> &copy; <a href="<?=$www;?>"><?=$site->getSystemInfo("authors");?></a> | <a href="https://validator.w3.org/nu/?doc=http%3A%2F%2Fuwe.reecebenson.me%2Fdsa-twincities%2F" target="_blank">Validate W3C</a>
            </div>
        </div>
        <?php require_once('pages/scripts.php'); ?>
        <script>
            /**
             * City Data
             */
            <?php
                $cityOneData = json_encode($site->getCityData($cities['city_one']['woeid']));
                $cityTwoData = json_encode($site->getCityData($cities['city_two']['woeid']));
            ?>
            let cityOne = <?=($cityOneData!=null ? $cityOneData : "{}");?>;
            let cityTwo = <?=($cityTwoData!=null ? $cityTwoData : "{}");?>;

            /**
             * Function for when waiting for a tab to load
             */
            function waitForLoad() {
                /**
                 * Elements
                 */
                let ajaxContent = $("#ajaxContent");

                // Set Element HTML
                ajaxContent.html("<div style='text-align: center; margin-top: 25px;'><img src='<?=$www;?>/gallery/img/load.gif'></div>");
            }
        </script>
    </body>
</html>