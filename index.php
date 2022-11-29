<?php 
header("Cache-Control: no-cache, must-revalidate");

require_once 'res/functions.php';   
switch ($_SERVER['REQUEST_URI']) { 
    case $LIB_SYS_DIR."";
        if (isset($_SESSION['USER_LOGIN']) ) {
            if ($_SESSION['USER_ROLE'] == "Students") {
                header('Location: students');
            } else {
                header('Location: ecnt');
            }        } else {
            include 'login.php';
        }       
    break;
    default:
        if (isset($_GET['code']) || isset($_GET['scope']) || isset($_GET['authuser']) == 1 || isset($_GET['prompt'])) {

            if (!isset($_SESSION['USER_LOGIN']) ) {

                include 'res/googleapi/google-auth.php';
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token['access_token']);      
    
                $google_oauth = new Google_Service_Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();
       
                require_once 'res/class/user.class.php'; 
    
                $user = new User(); 
                $userData = $user->checkUser($google_account_info); 
    
                $_SESSION['USER_LOGIN'] = true;
                $_SESSION['USER_AUTHID'] = $userData['oauth_uid'];
                $_SESSION['USER_ROLE'] = $userData['user_role'];
                $_SESSION['USER_EMAIL'] = $userData['email'];
                $_SESSION['USER_FIRST'] = $userData['first_name'];
                $_SESSION['USER_LAST'] = $userData['last_name'];
                $_SESSION['USER_CONFIG'] = $userData['isconfig'];      
                $_SESSION['USER_ID'] = $userData['user_id'];   
                $_SESSION['USER_PICTURE'] = $userData['picture'];   
            }
                   
            if ($_SESSION['USER_ROLE'] == "Student") {
                echo "
                <script>
                    window.location.replace('http://localhost:8080/libsys/students');
                </script>";
            } else {
                echo "
                <script>
                    window.location.replace('http://localhost:8080/libsys/ecnt');
                </script>";
            }
            
        } else {
            include 'login.php';
        }
    break;
}

?>
