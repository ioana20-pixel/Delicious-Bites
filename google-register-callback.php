<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();

$client->setClientId("769570673569-eh0qi71eci8ts5v0uk7vljep3apm2i6t.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost/final_project/google-register-callback.php");

if ( ! isset($_GET["code"])) {

    exit("Login failed");

}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);

$userinfo = $oauth->userinfo->get();

var_dump(
    $userinfo->email,
    $userinfo->familyName,
    $userinfo->givenName,
    $userinfo->name
);