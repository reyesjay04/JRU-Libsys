<?php


include_once '../../res/functions.php';


$arr = array($_POST['art_id']);

$article = GetSearchArticleByID($arr , false);
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
        "main_author" => GetUserFullName($prop['main_author_id']),
        "keyword" => $prop['keyword'],
        "created_at" => $prop['created_at'],
        "author_list" => GetAuthors($prop['id'])
    );
}   

foreach($responselist as $response){
    
    $userComments = GetArticleComments($response['art_id']);
    $userLikes = CheckIfUserLikes($response['art_id']);
    $userDislikes = CheckIfUserDislikes($response['art_id']);
    
    $main_author = $response['main_author'];
    $availability = "";
    if($response['availability'] == "PUB") {
        $availability = 'Public';
    } else if($response['availability'] == "PRIV") {
        $availability = 'Private';
    } else {
        $availability = 'Public/Private';
    }

    $rateratio = GetRateRatio($response['art_id']);
    $userRating = GetUserArticleRating($response['art_id']);
?>

    <div class="card-header">
        <div class="user-block">
            <img class="img-circle" src="<?php echo $main_author[0]['picture']; ?>" alt="User Image">
            <span class="username"><a href="#"><?php echo $response['title']; ?></a></span>
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
    </div>

    <div class="card-body">
        <p><?php echo $response['content'];?></p>
        <div class="attachment-block clearfix">
            <a type="button"id="<?php echo $response['file'];?>" onclick="downloadFile(this.id)" class="link-black text-sm"><i class="fas fa-link mr-1"></i><?php echo $response['file'];?></a>
        </div>
        <button type="button" onclick="LikeArticle(this)" id="btnlike" class="btn btn-<?php echo ($userLikes > 0 ? "primary":"default")?> btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
        <button type="button" onclick="DislikeArticle(this)" id="btndislike" class="btn btn-<?php echo ($userDislikes > 0 ? "primary":"default")?> btn-sm"><i class="far fa-thumbs-down"></i> Dislike</button>
        <span class="float-right text-muted">
            <a id="ratingsratio"><?php echo ($rateratio == "" ? 0 : $rateratio);?></a> ratings - 
            <a id="likescount"><?php echo GetArticleLikes($response['art_id']);?></a> likes - 
            <a id="dislikescount"><?php echo GetArticleDislikes($response['art_id']);?></a> dislikes - 
            <a id="commentscount"><?php echo GetArticleCommentCount($response['art_id']);?></a> comments      
        </span>
    </div>
    <div class="card-body box-profile">
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <a class="float-right">                        
                    <div class="rate">
                        <input type="radio" id="star5" onclick="rate(this.id)" <?php echo ($userRating == 5 ? "checked" : "");?> name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" onclick="rate(this.id)" <?php echo ($userRating == 4 ? "checked" : "");?> name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" onclick="rate(this.id)" <?php echo ($userRating == 3 ? "checked" : "");?> name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" onclick="rate(this.id)" <?php echo ($userRating == 2 ? "checked" : "");?> name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" onclick="rate(this.id)" <?php echo ($userRating == 1 ? "checked" : "");?> name="rate" value="1" />
                        <label for="star1" title="text">1 star</label> 
                    </div>  
                </a>
            </li>
        </ul>
    </div>

    <div class="card-footer card-comments" id="comments">
    <?php foreach($userComments as $comments){ ?>

        <div class="card-comment">

            <img class="img-circle img-sm" src="<?php echo $comments['picture'];?>" alt="User Image">

            <div class="comment-text">
                <span class="username">
                <?php echo $comments['first_name'] . ' ' . $comments['last_name'];?>
                    <span class="text-muted float-right">
                        <?php echo $comments['created_at'];?>
                    </span>
                </span><!-- /.username -->
                <?php echo $comments['comment'];?>

            </div>
        </div>
    <?php } ?>
    </div>

        <!-- /.card-footer -->
    <div class="card-footer">
        <img class="img-fluid img-circle img-sm" src="<?php echo $_SESSION['USER_PICTURE']; ?>" alt="Alt Text">
        <!-- .img-push is used to add margin to elements next to floating images -->
        <div class="img-push">
        <input type="text" id="entercomment" class="form-control form-control-sm" placeholder="Press enter to post comment">
        </div>
    </div>

<?php } ?>