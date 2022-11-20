<?php


include_once '../../res/functions.php';

$newData = [
    "id" => $_POST['dept_id'],
    "name" => $_POST['deptname'],
    "code" => $_POST['deptcode'],
];

$result = UpdateDepartment($newData);

header('Location: ../?department');


?>