<?php

include_once '../../res/functions.php';


$articleList = GetSearchArticleByIDPending();

$responselist = array();

foreach($articleList as $article){
    $responselist[] = array(
        "art_id" => $article['id'],
        "title" => $article['title'],
        "dept_code" => $article['dept_code'],
        "cat_code" => $article['cat_code'],
        "content" => $article['content'],
        "file" => $article['file'],
        "availability" => $article['availability'],
        "view_count" => $article['view_count'],
        "main_author" => GetUserFullName($article['main_author_id']),
        "keyword" => $article['keyword'],
        "created_at" => $article['created_at'],
        "author_list" => GetAuthors($article['id'])
    );
}    


?>
<?php 
if (count($responselist) > 0) {
    foreach($responselist as $response){

        $availability = "";
        $articleID = $response['art_id'];
        if($response['availability'] == "PUB") {
            $availability = 'Public';
        } else if($response['availability'] == "PRIV") {
            $availability = 'Private';
        } else {
            $availability = 'Public/Private';
        }
        ?>

        <div class="post">
            <div class="user-block">
                <?php $main_author = $response['main_author']; ?>
                <img class="img-circle img-bordered-sm" src="<?php echo $main_author[0]['picture']; ?>" alt="user image">
                <span class="username">
                    <a href="#"><?php echo $response['title']; ?></a>
                </span>   
                <span class="description"><?php echo 'Publisher: '.$main_author[0]['first_name'].' '.$main_author[0]['last_name']; ?> - <?php echo date('F d, Y h:m:s A', strtotime($response['created_at'])); ?></span>
                <?php $author_list = $response['author_list'];?>
                <?php 
                    $appendNames = "";
                    foreach($author_list as $authors){ 
                        $appendNames .= $authors['first_name'].' '. $authors['last_name'].', ';
                    } 
                ?>
                <span class="description"><?php echo 'Authors: '.rtrim($appendNames,", "). ' | Availability: '. $availability;  ?></span>
            </div>
            <p>
                <?php echo $response['content'];?>
            </p>
            <p>
                <div class="col-2"><button class="btn btn-block btn-danger btn-xs" id="<?php echo $articleID;?>" onclick="cancelrequest(this.id)" ><i class="fas fa-ban mr-1"></i>Cancel Request</button></div>  
            </p>
        </div>
    <?php 
    }
} else {
    echo "<h5 class='text-center'>No Pending Request</h5>";
}
?>
