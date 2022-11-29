<?php

include_once '../../res/functions.php';

$Count = 0;
$array = explode(' - ', $_POST['dateval']);
foreach($array as $value) {

	if($Count == 0 ) {
		$Date1 = $value;
	}elseif ($Count > 0) {
		$Date2 = $value;
	}

$Count += 1;

}

$Date1 = date_create($Date1);
$Date1 = date_format($Date1,"Y-m-d");

$Date2 = date_create($Date2);
$Date2 = date_format($Date2,"Y-m-d");


echo SearchArticles($_POST['searchTerm'], $Date1, $Date2);

?>