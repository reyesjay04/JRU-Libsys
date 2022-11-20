<?php

include_once '../../res/functions.php';

$result = DeleteCategories($_POST['id']);

if ($result > 0) {
    echo "Success";
} else {
    echo "Unsuccessful";
}

?>