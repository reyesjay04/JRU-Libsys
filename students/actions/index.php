<?php



if(isset($_GET['getdept'])) {
    
    include 'getdept.php';

} else if(isset($_GET['getcourse'])) {
    
    include 'getcourse.php';

} else if(isset($_GET['configuser'])) {
    
    include 'configuser.php';

} else if(isset($_GET['search'])) {
    
    include 'search.php';

} else if(isset($_GET['getarticles'])) {
    
    include 'getarticles.php';

} else if(isset($_GET['searchauthors'])) {
    
    include 'searchauthors.php';

} else if(isset($_GET['addpost'])) {
    
    include 'addpost.php';

} else if(isset($_GET['logout'])) {
    
    include 'logout.php';

} else if(isset($_GET['requestaccess'])) {
    
    include 'requestaccess.php';

}  else if(isset($_GET['viewarticles'])) {
    
    include 'viewarticles.php';

} else if(isset($_GET['dlfile'])) {
    
    include 'filedownload.php';

} else if(isset($_GET['likearticle'])) {
    
    include 'likearticle.php';

} else if(isset($_GET['dislikearticle'])) {
    
    include 'dislikearticle.php';

} else if(isset($_GET['postcomment'])) {
    
    include 'postcomment.php';

} else if(isset($_GET['countcomments'])) {
    
    include 'countcomments.php';

} else if(isset($_GET['ratearticle'])) {
    
    include 'ratearticle.php';

} else if(isset($_GET['getarticlesrequest'])) {
    
    include 'getarticlesrequest.php';

} else if(isset($_GET['cancelrequest'])) {
    
    include 'cancelrequest.php';

}





?>