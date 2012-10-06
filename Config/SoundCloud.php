<?php
/**
 * A SoundCloud API Method Map
 *
 * Refer to the apis plugin for how to build a method map
 * @link https://github.com/ProLoser/CakePHP-Api-Datasources
 */
$config['Apis']['SoundCloud']['hosts'] = array(
	'oauth' => 'api.soundcloud.com', // Main domain+path for OAuth requests
	'rest' => 'api.soundcloud.com', // Main domain+path for REST requests
);

// http://developer.github.com/v3/oauth/
$config['Apis']['SoundCloud']['oauth'] = array(
/* 	'version' => '2.0', // 1.0, 2.0 or null */
/*   'scheme' => 'https', */
	// These paths are appended to the end of the Host-OAuth value
	'authorize' => 'connect', // Example URI: https://github.com/login/oauth/authorize
	'request' => 'requestToken', //client_id={$this->config['login']}&redirect_uri
	'access' => 'access_token', 
	'login' => 'authenticate', // Like authorize, just auto-redirects
	'logout' => 'invalidateToken', 
);

$config['Apis']['SoundCloud']['read'] = array(
  'oembed' => array(
    '/oembed',
    'url'
  ),
	// The 'fields' param should be set to this (the name of the resource)
	'tracks' => array( 		// This path is appended to the end of the Host-REST value
		'/users/:user_id/tracks' => array( 			// required conditions (optional, can be an empty array)
			'user_id',
			'optional' => array( 			// optional conditions (optional key)
			  'type'
		  )
		),
		'/resolve' => array(
		  'url'
		),
		'/tracks/:track_id' => array(			
			'track_id',
			'optional' => array(
				'type'
			),
		),
	),
	'user' => array(
		'/users/:user_id' => array(
			'user_id',
		),
		'user' => array(),
	),
);
// Refer to READ block
$config['Apis']['SoundCloud']['create'] = array();
// Refer to READ block
$config['Apis']['SoundCloud']['update'] = array();
// Refer to READ block
$config['Apis']['SoundCloud']['delete'] = array();