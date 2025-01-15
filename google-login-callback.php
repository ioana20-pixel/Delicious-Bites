<?php
session_start();
require_once 'vendor/autoload.php';


$client = new Google_Client();
$client->setClientId('769570673569-eh0qi71eci8ts5v0uk7vljep3apm2i6t.apps.googleusercontent.com'); 
$client->setClientSecret('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'); 
$client->setRedirectUri('http://localhost/final_project/google-login-callback.php'); 

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $_SESSION['access_token'] = $token['access_token'];
        $client->setAccessToken($token['access_token']);

        
        $google_oauth = new Google_Service_Oauth2($client);
        $user_info = $google_oauth->userinfo->get();

        
        $_SESSION['user_info'] = $user_info;

        

        // Redirect to the home page after successful login
        header('Location: index.php');
        exit();
    }
} else {
    // Redirect to login page if no code exists
    header('Location: login.php');
    exit();
}
?>
