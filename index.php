<?php

include 'res/config.php';

switch ($_SERVER['REQUEST_URI']) { 
    case $LIB_SYS_DIR."";
        include 'login.php';
    break;
}

?>