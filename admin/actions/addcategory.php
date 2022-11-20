<?php


include_once '../../res/functions.php';

AddCategory($_POST['categoryname'], $_POST['catcode']);

header('Location: ../?category');

?>