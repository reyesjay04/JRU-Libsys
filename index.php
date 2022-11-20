<?php session_start();

include 'res/config.php';
switch ($_SERVER['REQUEST_URI']) { 
    case $LIB_SYS_DIR."";
        session_destroy();
        if (isset($_SESSION['USER_LOGIN']) || isset($_SESSION['USER_EMAIL'])  || isset($_SESSION['USER_PROFILE']) ) {
            echo 'next page';
        } else {
            include 'login.php';
        }       
    break;
    default:
        if (isset($_GET['code']) || isset($_GET['scope']) || isset($_GET['authuser']) == 1 || isset($_GET['prompt'])) {
            include 'res/googleapi/google-auth.php';
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token['access_token']);      

            $google_oauth = new Google_Service_Oauth2($client);
            $google_account_info = $google_oauth->userinfo->get();

            require_once 'res/get-conn.php';
            require_once 'res/class/user.class.php'; 

            $user = new User(); 
            $userData = $user->checkUser($google_account_info); 

            $_SESSION['USER_ROLE'] = $userData['user_role'];
            $_SESSION['USER_EMAIL'] = $userData['email'];
            $_SESSION['USER_FIRST'] = $userData['first_name'];
            $_SESSION['USER_LAST'] = $userData['last_name'];

            if ($_SESSION['USER_ROLE'] == "Students") {
                header('Location: students');
            } else {
                header('Location: ecnt');
            }
                   
        } else {
            include 'login.php';
        }
    break;
}
?>