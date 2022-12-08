<?php

include_once '../../res/functions.php';


$articleList = GetRequestArticle($_SESSION['USER_ID']);

$responselist = array();

foreach($articleList as $article){
    $responselist[] = array(
        "art_id" => $article['id'],
        "user_id" => $article['user_id'],  
        "first_name" => $article['first_name'],
        "last_name" => $article['last_name'],
        "picture" => $article['picture'],
        "title" => $article['title'],
        "requested_at" => $article['requested_at'],
    );
}    



?>
<?php 
if(count($responselist) > 0) {

    foreach($responselist as $response){
        ?>
        <div class="post">
            <div class="user-block">
                <img class="img-circle img-bordered-sm" src="<?php echo $response['picture']?>" alt="user image">
                <span class="username">
                    <a href="#"><?php echo  $response['first_name'].' '.$response['last_name']; ?></a>
                </span>
                <span class="description"><?php echo 'Title: '. $response['title'];  ?></span>   
                <span class="description"><?php echo 'Date Requested: ' . date('F d, Y h:m:s A', strtotime($response['requested_at'])); ?></span>    
            </div>
            <p>
                <?php 
                    echo '<a href="actions/?acceptrequest='.$response['user_id'].'&art_id='.$response['art_id'].'" class="link-black text-sm mr-2"><i class="fas fa-check mr-1"></i> Accept</a>';
                ?>          
            </p>
        </div>
    <?php 
    }
} else {
    echo "<h6 class='text-center'>No Pending Request</h6>";
}
?>