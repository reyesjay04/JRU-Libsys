<?php


include_once '../../res/functions.php';

AddCourse($_POST['course'], $_POST['code']);

header('Location: ../?course');

?>