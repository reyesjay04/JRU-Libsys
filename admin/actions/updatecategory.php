<?php


include_once '../../res/functions.php';

$newData = [
    "cat_id" => $_POST['cat_id'],
    "cat_name" => $_POST['categoryname'],
    "cat_code" => $_POST['cat_code'],
];

$result = UpdateCategory($newData);

header('Location: ../?category');


?>