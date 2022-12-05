<?php


include_once '../../res/functions.php';

echo json_encode(GetUserStudentProfile($_SESSION['USER_ID']));
