<?php

include '../res/functions.php';

if(isset($_SESSION['ADMIN_USER'])) {

    $serverUrl = $_SERVER['REQUEST_URI'];

    switch ($serverUrl) {
        case $LIB_SYS_DIR.'admin/':
            include 'pages/dashboard.php';
            break;
        case $LIB_SYS_DIR.'admin/?dashboard':
            include 'pages/dashboard.php';
            break;
        case $LIB_SYS_DIR.'admin/?category':
            include 'pages/category.php';
            break;
        case $LIB_SYS_DIR.'admin/?post':
            include 'pages/post.php';
            break;
        case $LIB_SYS_DIR.'admin/?approvedpost':
            include 'pages/approved.php';
            break;
        case $LIB_SYS_DIR.'admin/?rejectedpost':
            include 'pages/rejected.php';
            break;
        case $LIB_SYS_DIR.'admin/?pendingpost':
            include 'pages/pending.php';
            break;
        case $LIB_SYS_DIR.'admin/?studentlist':
            include 'pages/studentlist.php';
            break;
        case $LIB_SYS_DIR.'admin/?course':
            include 'pages/course.php';
            break;
        case $LIB_SYS_DIR.'admin/?educators':
            include 'pages/educators.php';
            break;
        case $LIB_SYS_DIR.'admin/?department':
            include 'pages/department.php';
            break;
        case $LIB_SYS_DIR.'admin/?announcements':
            include 'pages/announcements.php';
        break;
        case $LIB_SYS_DIR.'admin/?engagements':
            include 'pages/engagements.php'; 
        break;
        default:
            include 'pages/dashboard.php';
    }

} else {
    include 'pages/login.php';
}

?>

<script>
function logout() {
    $.ajax({
      url:"actions/?logout",
      success:function(data){
        window.location.replace('<?php echo $LIB_SYS_DIR?>admin/');

      }

    });
}
</script>