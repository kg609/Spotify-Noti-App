<?php

use SpotifyLoginInfo;

require 'vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    'bc918caade28414794cc1bfc8519ed20',
    '6f406d87d4834de1bc83b2f81e97cb96',
    'http://localhost:8000/callback/'
);

$tokens = new SpotifyLoginInfo;

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

// Store the access and refresh tokens somewhere. In a database for example.
$tokens->access_token = $accessToken;
$tokens->refresh_token = $refreshToken;

$tokens->save();

// Send the user along and fetch some data!
header('Location: app.php');
die();