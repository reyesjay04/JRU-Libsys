<?php

require_once 'vendor/autoload.php';
$client = new Google\Client();
$client->setAuthConfig('../../res/googleapi/client_cred.json');
$client->addScope("email");
$client->addScope("profile");
$redirect_uri = 'http://localhost:8012/libsys/';
$client->setRedirectUri($redirect_uri);

?>