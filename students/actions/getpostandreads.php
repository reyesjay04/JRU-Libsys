<?php

include_once '../../res/functions.php';

echo json_encode(GetPostandReads($_SESSION['USER_ID']));

?>