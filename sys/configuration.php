<?php
	/**
	 * Configuration
	 *
	 * PHP version 5.6.30
	 *
	 * @author   Reece Benson, Lewis Cummins, Devon Davies
	 * @license  MIT License
	 * @link     http://github.com/reecebenson/dsa-twinnedcities/
	 */

	/**
	 * Load Configuration data from XML file
	 */
	$db_type = "live";
	$configData = simplexml_load_file(__DIR__."/configuration.xml");

	/**
	 * Database Data
	 * 
	 * @param string user Holds the username of the database account
	 * @param string pass Holds the password of the database account
	 * @param string host Holds the host of the database
	 * @param string name Holds the table of what PDO should connect to
	 */
	$db_details = array(
        'user' => $configData->database->$db_type->username,
        'pass' => $configData->database->$db_type->password,
        'host' => $configData->database->$db_type->host,
        'name' => $configData->database->$db_type->name
	);
	
	/**
	 * Google Maps Data
	 * 
	 * @param string key						Google Maps API Key
	 */
	$gm_details = array(
		'key' => $configData->googlemaps->key
	);

	/**
	 * Twitter Data
	 * 
	 * @param string oauth_access_token 		Twitter Access Token
	 * @param string oauth_access_token_secret	Twitter Access Token (Secret)
	 * @param string consumer_key 				Twitter Consumer Key
	 * @param string consumer_secret			Twitter Consumer Secret
	 */
	$tw_details = array(
		'oauth_access_token' => $configData->twitter->oauth_access_token,
		'oauth_access_token_secret' => $configData->twitter->oauth_access_token_secret,
		'consumer_key' => $configData->twitter->consumer_key,
		'consumer_secret' => $configData->twitter->consumer_secret
	);

	/**
	 * Flickr Data
	 * 
	 * @param string key 		Flickr Access Key
	 * @param string id			Flickr Access Identifier
	 */
	$fl_details = array(
		'key' => $configData->flickr->key,
		'id' => $configData->flickr->id
	);

	/**
	 * OpenWeatherMap
	 * 
	 * @param string key		Open Weather Map Key
	 * @param string api_base	Open Weather Map URL Base
	 */
	$owm_details = array(
		'key' => $configData->openweathermap->key,
		'api_base' => $configData->openweathermap->api_base
	);
?>