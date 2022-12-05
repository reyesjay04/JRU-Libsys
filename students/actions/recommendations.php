<?php


include_once '../../res/functions.php';


$article = Recommendations();
$responselist = array();

foreach($article as $prop){
    $responselist[] = array(
        "art_id" => $prop['id'],
        "title" => $prop['title'],
        "dept_code" => $prop['dept_code'],
        "cat_code" => $prop['cat_code'],
        "content" => $prop['content'],
        "file" => $prop['file'],
        "availability" => $prop['availability'],
        "view_count" => $prop['view_count'],
        "main_author" => GetUserFullName($prop['main_author_id']),
        "keyword" => $prop['keyword'],
        "created_at" => $prop['created_at'],
        "author_list" => GetAuthors($prop['id']),
        "rate" => $prop['Rate'],
        "likes" => $prop['Likes'],
        "dislikes" => $prop['DisLikes'],
    );
}   

foreach($responselist as $response){

    if($_POST['viewarticle'] !== $response['art_id']) {

    ?>
        <div class="col-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                <span class="info-box-number text-center"><?php echo $response['title']; ?></span>
                <span class="info-box-text text-center">Ratings - <?php echo (is_null($response['rate']) ? 0 : $response['rate']); ?></span>
                <span class="info-box-text text-center">Likes - <?php echo (is_null($response['likes']) ? 0 : $response['likes']); ?></span>
                <span class="info-box-text text-center">Dislikes - <?php echo (is_null($response['dislikes']) ? 0 : $response['dislikes']); ?></span>
                <a href="?viewarticle=<?php echo $response['art_id']; ?>&avl=<?php echo $response['availability']; ?>" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> View Article</a>

                </div>
            </div>
        </div>
    
<?php 
    }
} ?>