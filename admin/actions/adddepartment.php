<?php


include_once '../../res/functions.php';

$result = AddDepartment($_POST['deptcode'], $_POST['deptname']);

header('Location: ../?department');

?>