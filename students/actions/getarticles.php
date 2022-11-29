<?php

include_once '../../res/functions.php';

$isAll = true;
if(isset($_POST['art_id'])) {
    $isAll = false;
    $articleList = GetSearchArticleByID($_POST['art_id'], $isAll);
} else {
    $articleList = GetSearchArticleByID("", $isAll);
}

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
            <?php 
                switch ($response['availability']) {
                    case "PUB";
                        echo '<a href="?viewarticle='.$articleID.'&avl='.$response['availability'].'" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> View Article</a>';
                    break;
                    case "PRIV";
                        if(CheckUserAccess($articleID) > 0) {
                            if(CheckUserAccessStatus($articleID) > 0) {
                                echo '<a href="?viewarticle='.$articleID.'&avl='.$response['availability'].'" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> View Article</a>';
                            } else {
                                echo '<div class="col-2"><button class="btn btn-block btn-warning btn-xs"><i class="fas fa-user-secret mr-1"></i>Waiting for approval</button></div>';
                            }
                        } else {
                            echo '<div class="col-2"><button class="btn btn-block btn-secondary btn-xs" id="'.$articleID.'" onclick="request(this.id)"><i class="fas fa-user-secret mr-1"></i>Request access</button></div>';
                        }
                    break;
                    default:
                        echo '123123';
                    break;
                }
            ?>    
        </p>
    </div>
<?php 
}
?>
