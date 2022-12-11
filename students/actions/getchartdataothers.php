<?php


include_once '../../res/functions.php';

$result = GetChartData($_POST['id']);

echo json_encode($result); 
