<?php

include_once '../../res/functions.php';

$fileupload = $_FILES["fileupload"]["name"] ;
$fileuploadtemp = $_FILES["fileupload"]["tmp_name"] ;
$fileuploaderror = $_FILES["fileupload"]["error"] ;
// print_r($_POST['tags']);

$fileExt = explode('.', $fileupload);
$fileActualExt = strtolower(end($fileExt));

$filename_without_ext = substr($fileupload, 0, strrpos($fileupload, "."));
$fileNewName = $filename_without_ext.uniqid().".".$fileActualExt;

$destination_path = getcwd().DIRECTORY_SEPARATOR;
$target_path =  $destination_path ."../uploads/". basename($fileNewName);
@move_uploaded_file($_FILES['fileupload']['tmp_name'], $target_path);

$newArticle = [
    "title" => $_POST['title'],
    "dept_code" => $_POST['dept'],
    "cat_code" => $_POST['course'],
    "content" => $_POST['content'],
    "file" => $fileNewName,
    "availability" => $_POST['availability'],
    "keyword" => $_POST['keywords'],
];

$newAuthorList = array();

$authorList = json_decode($_POST['tags'], true);

foreach($authorList as $authors){
    if($authors['id'] !== $_SESSION['USER_ID']) {
        $newAuthorList[] = array(
            "id" => $authors['id'],
            "name" => $authors['text'],
        );
    }
}    

if(AddPost($newArticle,$newAuthorList)) {
    echo "Success";
} else {
    echo "Unsuccessful";
}



?>
