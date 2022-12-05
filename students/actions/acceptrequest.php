<?php

include_once '../../res/functions.php';



AcceptRequest($_GET['acceptrequest'], $_GET['art_id']);

echo '<script>';
echo 'self.location = "../?profile";';
echo '</script>';

?>