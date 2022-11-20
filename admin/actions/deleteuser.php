<?php

include_once '../../res/functions.php';

$result = DeleteUser($_POST['id']);

if ($result > 0) {
    echo "Success";
} else {
    echo "Unsuccessful";
}

?>