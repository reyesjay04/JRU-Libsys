<?php session_start();
date_default_timezone_set('Asia/Manila');
function FullDateFormat24HR() {
    return date("Y-m-d H:i:s");
}

function GetAdmin($user, $pass) {
    include 'get-conn.php';
    
    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `admin` WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $user, "password" => md5($pass)]); 
    $row = $stmt->rowCount();
    
    if($row > 0) {
        $row = $stmt->fetch();
        $newData = [
            "STATUS" => 1,
            "ADMIN_USERNAME" => $user,
            "ROLE" => "ADMIN",
            "FIRST_NAME" => $row['firstname'],
            "LAST_NAME" =>  $row['lastname'],
            "EMAIL" => $row['email']
        ];
    } else {
        $newData = [
            "STATUS" => 0,
        ];
    }

    return $newData;

}
#region Categories
function AddCategory($categoryName, $catcode) {
    include 'get-conn.php';

    $newData = [
        "cat_code" => $catcode,
        "cat_name" => $categoryName,
        "created_by" => $_SESSION['ADMIN_USER'],
        "created_at" => FullDateFormat24HR(),
    ];

    $sql = "INSERT INTO categories (`cat_code`, `cat_name`, `created_by`, `created_at`) VALUES (:cat_code, :cat_name, :created_by, :created_at)";
    $pdo->prepare($sql)->execute($newData);

}

function DeleteCategories($id) {
    include 'get-conn.php';

    $sql = "DELETE FROM categories WHERE cat_id= :cat_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["cat_id" => $id]);  
    return $stmt->rowCount();

}

function GetCategoryDetails($id) {
    include 'get-conn.php';
    
    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE cat_id = :cat_id");
    $stmt->execute(['cat_id' => $id]); 
    $row = $stmt->fetch();

    $newData = [
        "cat_name" => $row['cat_name'],
        "cat_id" => $row['cat_id'],
        "cat_code" => $row['cat_code'],
    ];

    return $newData;

}

function UpdateCategory($data) {
    include 'get-conn.php';

    $data['updated_at'] = FullDateFormat24HR();  
    $data['updated_by'] = $_SESSION['ADMIN_USER'];  

    $sql = "UPDATE categories SET cat_code = :cat_code, cat_name = :cat_name, updated_at = :updated_at, updated_by = :updated_by  WHERE cat_id = :cat_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute($data);  
    return $stmt->rowCount();

}
#region

#region Users
function DeleteUser($id) {
    include 'get-conn.php';

    $sql = "DELETE FROM users WHERE id= :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);  
    return $stmt->rowCount();

}
#endregion

#region Course

function AddCourse($course, $code) {
    include 'get-conn.php';

    $newData = [
        "code" => $code,
        "course" => $course,
        "created_by" => $_SESSION['ADMIN_USER'],
        "created_at" => FullDateFormat24HR(),
    ];

    $sql = "INSERT INTO course (`code`, `course`, `created_by`, `created_at`) VALUES (:code, :course, :created_by, :created_at)";
    $pdo->prepare($sql)->execute($newData);

}
function GetCourseDetails($id) {
    include 'get-conn.php';
    
    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `course` WHERE id = :id");
    $stmt->execute(['id' => $id]); 
    $row = $stmt->fetch();

    $newData = [
        "code" => $row['code'],
        "course" => $row['course'],
        "id" => $row['id'],
    ];

    return $newData;

}

function UpdateCourse($data) {
    include 'get-conn.php';

    $data['updated_at'] = FullDateFormat24HR();  
    $data['updated_by'] = $_SESSION['ADMIN_USER'];  
    try {
        $sql = "UPDATE `course` SET code = :code,  course = :course, updated_at = :updated_at, updated_by = :updated_by  WHERE id = :id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);  
        return $stmt->rowCount();
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function DeleteCourse($id) {
    include 'get-conn.php';

    $sql = "DELETE FROM course WHERE id= :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);  
    return $stmt->rowCount();

}


#endregion

#region Departments
function GetDepartments() {
    include 'get-conn.php';

    $stmt = $pdo->prepare("SELECT `code`, `name` FROM department WHERE status = 'Y'");
    $stmt->execute(); 
    $get_depts = array();
    while($row = $stmt->fetchall()) {

        $code= $row['code'];
        $name = $row['name'];
        $get_depts[] = array("Code" => $code, "Name" => $name);
    }


    return json_encode($get_depts);
}
#endregion
?>