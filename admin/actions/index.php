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

} else if(isset($_GET['getdeptdata']))  { 

    include 'getdeptmodaldata.php';

} else if(isset($_GET['adddept']))  { 

    include 'adddepartment.php';

} else if(isset($_GET['updatedept']))  { 

    include 'updatedepartment.php';

}  else if(isset($_GET['getdept']))  { 

    include 'getdept.php';

}  else if(isset($_GET['deletedept']))  { 

    include 'deletedepartment.php';

}  else if(isset($_GET['logout']))  { 

    include 'logout.php';

}  else if(isset($_GET['approvepost']))  { 

    include 'approvepost.php';

} else if(isset($_GET['disapprovepost']))  { 

    include 'disapprovepost.php';

} else if(isset($_GET['addannouncement']))  { 

    include 'addannouncement.php';

} else if(isset($_GET['getdashdetails']))  { 

    include 'getdashdetails.php';

} else if(isset($_GET['getcount']))  { 

    include 'getcount.php';

}







?>