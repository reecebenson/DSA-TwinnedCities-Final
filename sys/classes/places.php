<?php
	/**
	 * Places
	 *
	 * PHP version 5.6.30
	 *
	 * @author   Reece Benson, Lewis Cummins, Devon Davies
	 * @license  MIT License
	 * @link     http://github.com/reecebenson/dsa-twinnedcities/
	 */

    class Places {
		/**
		 * Open Weather Map Base URL
		 * @var string
		 */
        public static $openWeatherMap = null;
        
		/**
		 * Open Weather Map API Key
		 * @var string
		 */
        public static $openWeatherMapKey = null;
        
		/**
		 * Query the Open Weather Map API
		 * 
		 * @param string $apiType The type of API request we want to make
         * @param array  $args    The arguments we want to pass to the API
		 *
		 * @return array Returns an array from the JSON format
		 */
        public static function queryOpenWeatherMap($apiType, $args)
        {
			$qryUrl = self::$openWeatherMap . "/" . $apiType . "?APPID=" . self::$openWeatherMapKey . "&" . $args;
            $data = json_decode(file_get_contents($qryUrl), true);
            return $data;
        }

		/**
		 * Send a API request that retrieves the weather data from OpenWeatherMap
         * from the Latitude and Longitude of a location
		 * 
		 * @param float $lat  Latitude
         * @param float $long Longitude
		 *
		 * @return array Returns an array from the JSON format
		 */   
        public static function queryPlaceWeather($lat, $long) {
            $args = array(
                "lat" => $lat,
                "lon" => $long
			);
            return self::queryOpenWeatherMap("weather", http_build_query($args));
		}
		
		/**
		 * Send a API request that retrieves the forecast data from OpenWeatherMap
		 * from the Latitude and Longitude of a location
		 * 
		 * @param float $lat  Latitude
		 * @param float $long Longitude
		 * 
		 * @return array Returns an array from the JSON format
		 */
		public static function queryPlaceForecast($lat, $long) {
            $args = array(
                "lat" => $lat,
                "lon" => $long
			);
            return self::queryOpenWeatherMap("forecast", http_build_query($args));
		}

		/**
		 * Convert degrees into the compass format
		 * 
		 * @param int $d The degree of that to convert
		 *
		 * @return string Returns the formatted degree
		 */   
        public static function getCompassFromDegree($d) {
			$dirs = array('↑ N', '↗ NE', '→ E', '↘ SE', '↓ S', '↙ SW', '← W', '↖ NW', '↑ N'); 
			return $dirs[round($d/45)];
        }
    }
?>