<?php


include_once '../../res/functions.php';

$result = GetPostandReads($_POST['id']);

foreach($result as $article){
?>

    <h3 class="text-center">Total Post Views: <?php echo $article["totalreads"]?></h3>

<?php

}