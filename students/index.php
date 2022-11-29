<?php 
include '../res/functions.php';

if(isset($_SESSION['USER_ROLE'])) {

    if($_SESSION['USER_CONFIG'] == "N") {
        include 'pages/config-user.php';
    } else {
        switch ($_SERVER['REQUEST_URI']) { 
            case $LIB_SYS_DIR_STUD."";
                include 'pages/dashboard.php';
            break;
            case $LIB_SYS_DIR_STUD."?dashboard";
            include 'pages/dashboard.php';
            break;
            case $LIB_SYS_DIR_STUD."?post";
                include 'pages/post.php';
            break;
            case $LIB_SYS_DIR_STUD."?request";
                include 'pages/view-request.php';
            break;
            case $LIB_SYS_DIR_STUD."?profile";
                include 'pages/profile.php';
        break;
            case $LIB_SYS_DIR_STUD."?viewarticle=".$_GET['viewarticle']."&avl=".$_GET['avl'];
                include 'pages/view-article.php';
            break;
        }
      
    }

} else {

    header("Location: ../");

}

?>

<script>
function logout() {
    $.ajax({
      url:"actions/?logout",
      success:function(data){
        window.location.replace('<?php echo $LIB_SYS_DIR_STUD?>');

      }

    });
}
</script>