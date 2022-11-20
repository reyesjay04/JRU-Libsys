<?php 
include_once '../../res/functions.php';

$user = $_POST['username'];
$pass = $_POST['password'];

$adDetails = GetAdmin($user, $pass);


if ($adDetails['STATUS'] == 1) {

    $_SESSION['ADMIN_USER'] = $adDetails['ADMIN_USERNAME'];
    $_SESSION['ADMIN_USERNAME'] = $adDetails['ADMIN_USERNAME'];
    $_SESSION['ROLE'] = $adDetails['ROLE'];
    $_SESSION['FIRST_NAME'] = $adDetails['FIRST_NAME'];
    $_SESSION['LAST_NAME'] = $adDetails['LAST_NAME'];
    $_SESSION['EMAIL'] = $adDetails['EMAIL'];

    header('Location: ../');
    
}  else {

    header('Location: ../?err=true');
}
?>

