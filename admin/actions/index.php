<?php

if(isset($_GET['login'])) {
    
    include 'getuser.php';

} else if(isset($_GET['addcat']))  {
    
    include 'addcategory.php';

} else if(isset($_GET['delcat']))  { 

    include 'deletecategory.php';

} else if(isset($_GET['getcatdata']))  { 

    include 'getcategorymodaldata.php';

} else if(isset($_GET['updatecat']))  { 

    include 'updatecategory.php';

} else if(isset($_GET['deluser']))  { 

    include 'deleteuser.php';

} else if(isset($_GET['addcourse']))  { 

    include 'addcourse.php';

} else if(isset($_GET['getcoursedata']))  { 

    include 'getcoursedata.php';

} else if(isset($_GET['updatecourse']))  { 

    include 'updatecourse.php';

} else if(isset($_GET['deletecourse']))  { 

    include 'deletecourse.php';

}




?>