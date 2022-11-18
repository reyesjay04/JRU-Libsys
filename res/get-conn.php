<?php

include 'config.php';

if($FAB_DIR == '/libsys/') {
    include 'conn-local.php';
} else {
    include 'conn-server.php';
}


?>