<?php

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('80572498313-03ofk3hi2ute7mupodcmjhd2e4u3hc60.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('https://emrmarketing.in/');

//
$google_client->addScope('email');

$google_client->addScope('profile');

//start session on web page
//session_start();

?>