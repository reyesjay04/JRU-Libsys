<?php



if(isset($_GET['getdept'])) {
    
    include 'getdept.php';

} else if(isset($_GET['getcourse'])) {
    
    include 'getcourse.php';

} else if(isset($_GET['configuser'])) {
    
    include 'configuser.php';

}


?>