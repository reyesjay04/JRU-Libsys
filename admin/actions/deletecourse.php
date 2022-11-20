<?php

include_once '../../res/functions.php';

$result = DeleteCourse($_POST['id']);

if ($result > 0) {
    echo "Success";
} else {
    echo "Unsuccessful";
}

?>