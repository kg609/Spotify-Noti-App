<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpotifyWebAPI;

class SpotifyLoginController extends Controller
{
    public function index()
    {
        $session = new SpotifyWebAPI\Session(
            'bc918caade28414794cc1bfc8519ed20',
            '6f406d87d4834de1bc83b2f81e97cb96',
            'http://localhost:8000/spotifylogin/'
        );

        $options = [
            'scope' => [
                'playlist-read-private',
                'user-read-private',
            ],
        ];
        

        // dd($session->getAuthorizeUrl($options));

        header('Location:' . $session->getAuthorizeUrl($options));
        die();
    
        // Request a access token using the code from Spotify
        $session->requestAccessToken($_GET['code']);

        // dd($session->requestAccessToken($_GET['code']));

        $accessToken = $session->getAccessToken();
        $refreshToken = $session->getRefreshToken();

        // dd($accessToken);

        // Store the access token somewhere. In a database for example.
        $tokens->access_token = $accessToken;
        $tokens->refresh_token = $refreshToken;

        // $tokens->save();

        // // Send the user along and fetch some data!
        header('Location: app.php');
        die();

        
        return view('spotifylogin');
    }
}
