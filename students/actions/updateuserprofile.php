<?php

include_once '../../res/functions.php';

$fileNewName = "";

if (file_exists($_FILES['profilepic']['tmp_name']) || is_uploaded_file($_FILES['profilepic']['tmp_name'])) 
{
    $fileupload = $_FILES["profilepic"]["name"] ;
    $fileuploadtemp = $_FILES["profilepic"]["tmp_name"] ;
    $fileuploaderror = $_FILES["profilepic"]["error"] ;
    // print_r($_POST['tags']);
    
    $fileExt = explode('.', $fileupload);
    $fileActualExt = strtolower(end($fileExt));
    
    $filename_without_ext = substr($fileupload, 0, strrpos($fileupload, "."));
    $fileNewName = $filename_without_ext.uniqid().".".$fileActualExt;
    
    $destination_path = getcwd().DIRECTORY_SEPARATOR;
    $target_path =  $destination_path ."../uploads/". basename($fileNewName);
    @move_uploaded_file($_FILES['profilepic']['tmp_name'], $target_path);
}

$updateProfile = [
    "reference_id" => $_POST['reference_id'],
    "first_name" => $_POST['firstname'],
    "last_name" => $_POST['lastname'],
    "gender" => $_POST['gender'],
    "course" => $_POST['course'],
    "dept" => $_POST['dept'],
    "contact" => $_POST['contact'],
];

if($fileNewName !== "") {
    $savePath = UPLOAD_PATH_STUDENT.$fileNewName;
    $updateProfile['picture'] =  $savePath ;
}

UpdateUserProfile($updateProfile);


echo '<script>';
echo 'self.location = "../?profile";';
echo '</script>';

?>
