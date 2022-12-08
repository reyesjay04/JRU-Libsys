<?php

include_once '../../res/functions.php';

$res = ViewAnnouncement();


?>

<div class="callout callout-info">
    <h5>Title: <?php echo $res['title']?></h5>
    <p>Date Announced: 
        <?php 
        
        $date = date_create($res['created_at']);
        echo date_format($date,"M d, Y h:i:s A");
        ?>
    </p>
    <p><?php echo $res['description']?></p>
    <div class="attachment-block clearfix">
        <a type="button" id="<?php echo $res['filename']?>" onclick="downloadFile(this.id)" class="link-black text-sm"><i class="fas fa-link mr-1"></i><?php echo $res['filename']?></a>
    </div>
</div>