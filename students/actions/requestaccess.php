<?php

include_once '../../res/functions.php';



if(GenerateUserAccess($_POST['art_id'])) {
    echo "New";
} else {
    echo "Exist";
}


?>