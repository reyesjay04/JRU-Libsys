<?php 
include '../res/functions.php';

if(isset($_SESSION['USER_ROLE'])) {

    if($_SESSION['USER_CONFIG'] == "N") {
        include 'config-user.php';
    } else {
        switch ($_SERVER['REQUEST_URI']) { 
            case $LIB_SYS_DIR_STUD."";
            include 'dashboard.php';
        }
      
    }

} else {

    header("Location: ../");

}

?>