<?php

include_once '../../res/functions.php';

$arr = array();

if($_POST['action'] == "Yes") {
    $dislikesCount = DislikeArticle($_POST['art_id']);
} else {
    $dislikesCount = UndislikeArticle($_POST['art_id']);
}

$likesCount = GetArticleLikes($_POST['art_id']);

$responselist[] = array(
    "likes" => $likesCount,
    "dislikes" => $dislikesCount,
);


echo json_encode($responselist);

?>