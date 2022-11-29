<?php


include_once '../../res/functions.php';


$result = PostComment($_POST['art_id'], $_POST['comment']);
?>


<?php foreach($result as $comments){ ?>

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
