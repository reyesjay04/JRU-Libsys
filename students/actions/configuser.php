<?php


include_once '../../res/functions.php';

$userData = [
    "oauth_uid" => $_POST['oauth_uid'],
    "first_name" => $_POST['first_name'],
    "last_name" => $_POST['last_name'],
    "reference_id" => $_POST['student_no'],
    "department_code" => $_POST['dept'],
    "course_code" => $_POST['course'],
    "contact_number" => $_POST['contact_no'],
    "gender" => $_POST['gender'],  
];

$result = UpdateStudentConfig($userData);

if ($result > 0) {
    $_SESSION['USER_CONFIG'] = "Y";
    echo "Success";
    header('Location: ../');
} else {
    echo "Unsuccessful";
    header('Location: ../');
}

?>