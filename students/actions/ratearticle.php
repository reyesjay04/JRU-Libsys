<?php

include_once '../../res/functions.php';


$art_id = $_POST['art_id'];
$rating = $_POST['id'];
$ratingOfficial = 0;

switch ($rating) {
    case "star5";
        $ratingOfficial = 5;
    break;
    case "star4";
        $ratingOfficial = 4;
    break;
    case "star3";
        $ratingOfficial = 3;
    break;
    case "star2";
        $ratingOfficial = 2;
    break;
    case "star1";
        $ratingOfficial = 1;
    break;
}

echo RateArticle($art_id, $ratingOfficial);

?>