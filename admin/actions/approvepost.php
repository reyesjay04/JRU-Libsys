<?php


include_once '../../res/functions.php';

$result = ApprovePost($_POST['id']);

echo $result;

//header('Location: ../?department');

?>