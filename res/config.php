<?php

$LIB_SYS_DIR = "/libsys/";
$LIB_SYS_DIR_STUD = "/libsys/students/";

define('UPLOAD_PATH_STUDENT', '../students/uploads/');
define('UPLOAD_PATH_ADMIN',   '../admin/uploads/');

if($LIB_SYS_DIR == '/libsys/') {
    include 'conn-local.php';
} else {
    include 'conn-server.php';
}

?>