<?php


include_once '../../res/functions.php';

$newData = [
    "id" => $_POST['id'],
    "course" => $_POST['course'],
    "code" => $_POST['code'],
];

$result = UpdateCourse($newData);

header('Location: ../?course');


?>