<?php

$LIB_SYS_DIR = "/libsys/";
$LIB_SYS_DIR_STUD = "/libsys/students/";

if($LIB_SYS_DIR == '/libsys/') {
    include 'conn-local.php';
} else {
    include 'conn-server.php';
}

?>