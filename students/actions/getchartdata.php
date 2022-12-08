<?php


include_once '../../res/functions.php';

$result = GetChartData($_SESSION['USER_ID']);

echo json_encode($result); 
