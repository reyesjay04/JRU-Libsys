<?php

include_once '../../res/functions.php';

AddCourse($_POST['course'], $_POST['code'], $_POST['dept']);

header('Location: ../?course');

?>