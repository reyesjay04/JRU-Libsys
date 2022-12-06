<?php


include_once '../../res/functions.php';

SeenNotification($_POST['id']);

$data = GetNotification();

$response = array();

?>
    <span class="dropdown-header" ><?php echo count($data); ?> Notifications</span>
<?php
foreach($data as $notif){
    $icon = "";
    $interval = time_since(time() - strtotime($notif['created_at']));

    $str = strtolower($notif['type']);
    switch ($notif['type']) {
        case 'LIKE':
            $icon = "fas fa-thumbs-up";
        break;
        case 'UNLIKE';
            $icon = "far fa-thumbs-up";
        break;
        case 'DISLIKES':
            $icon = "fas fa-thumbs-down";
        break;
        case 'UNDISLIKE':
            $icon = "far fa-thumbs-down";
        break;
        case 'COMMENT':
            $icon = "fas fa-comment";
        break;
        case 'RATING';
            $icon = "fas fa-star";
        break;
        default:
            $icon = "fas fa-envelope";
        break;
    }
?>
    <div class="dropdown-divider"></div>
    <a href="#" id="<?php echo $notif['id']?>" onclick="seennotif(this.id)" class="dropdown-item">
        <i class="<?php echo $icon;?> mr-2"></i> <?php echo $notif['TotalNotif']; ?> new <?php echo $str; ?>
        <span class="float-right text-muted text-sm"><?php echo $interval;?> ago</span>
    </a>
<?php
}
