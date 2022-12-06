<?php

include_once '../../res/functions.php';

$arr = array();

if($_POST['action'] == "Yes") {
    $likesCount = LikeArticle($_POST['art_id']);
    AddNotification("LIKE", $_POST['art_id']);

} else {
    $likesCount = UnlikeArticle($_POST['art_id']);
    AddNotification("UNLIKE", $_POST['art_id']);

}

$dislikesCount = GetArticleDislikes($_POST['art_id']);

$responselist[] = array(
    "likes" => $likesCount,
    "dislikes" => $dislikesCount,
);

echo json_encode($responselist);

?>