<?php session_start();

include '../../res/googleapi/google-logout.php';

// Remove token and user data from the session
unset($_SESSION['token']);
unset($_SESSION['userData']);

// Reset OAuth access token
$client->revokeToken();

session_destroy();

header('Location: ../');

?>

