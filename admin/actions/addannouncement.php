<?php
include_once '../../res/functions.php';


$fileNewName = "";

if (file_exists($_FILES['attachment']['tmp_name']) || is_uploaded_file($_FILES['profilepic']['tmp_name'])) 
{
    $fileupload = $_FILES["attachment"]["name"] ;
    $fileuploadtemp = $_FILES["attachment"]["tmp_name"] ;
    $fileuploaderror = $_FILES["attachment"]["error"] ;
    // print_r($_POST['tags']);
    
    $fileExt = explode('.', $fileupload);
    $fileActualExt = strtolower(end($fileExt));
    
    $filename_without_ext = substr($fileupload, 0, strrpos($fileupload, "."));
    $fileNewName = $filename_without_ext.uniqid().".".$fileActualExt;
    
    $destination_path = getcwd().DIRECTORY_SEPARATOR;
    $target_path =  $destination_path ."../uploads/". basename($fileNewName);
    @move_uploaded_file($_FILES['attachment']['tmp_name'], $target_path);
}

$savePath = UPLOAD_PATH_ADMIN.$fileNewName;

$data = [
    "title" => $_POST['title'],
    "description" => $_POST['desc'],
    "filename" => $fileNewName,
    "attachment" => $savePath,
];

AddAnnouncements($data);

// header('Location: ../?announcements');

?>