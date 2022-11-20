<?php

include 'config.php';

if($LIB_SYS_DIR == '/libsys/') {
  
    include 'conn-local.php';
} else {
    include 'conn-server.php';
}

?>