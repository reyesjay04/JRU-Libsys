<?php session_start();
date_default_timezone_set('Asia/Manila');

include 'config.php';

function ConnectionArray() {
	return $dbDetails = array('host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASSWORD, 'db' => DB_NAME);
} 

function FullDateFormat24HR() {
    return date("Y-m-d H:i:s");
}

function GetAdmin($user, $pass) {
    require_once("connection.php");
    $pdo = Database::getConnection();

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
    $stmt->closeCursor();
    return $newData;

}
#region Categories
function AddCategory($categoryName, $catcode) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [
        "cat_code" => $catcode,
        "cat_name" => $categoryName,
        "created_by" => $_SESSION['ADMIN_USER'],
        "created_at" => FullDateFormat24HR(),
    ];
  
    try {
        $sql = "INSERT INTO categories (`cat_code`, `cat_name`, `created_by`, `created_at`) VALUES (:cat_code, :cat_name, :created_by, :created_at)";
        $stmt = $pdo->prepare($sql)->execute($newData);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function DeleteCategories($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "DELETE FROM categories WHERE cat_id= :cat_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["cat_id" => $id]);  
    $res = $stmt->rowCount();
    $stmt->closeCursor();
    return $res;
}

function GetCategoryDetails($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `categories` WHERE cat_id = :cat_id");
    $stmt->execute(['cat_id' => $id]); 
    $row = $stmt->fetch();

    $newData = [
        "cat_name" => $row['cat_name'],
        "cat_id" => $row['cat_id'],
        "cat_code" => $row['cat_code'],
    ];
    $stmt->closeCursor();
    return $newData;
}

function UpdateCategory($data) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $data['updated_at'] = FullDateFormat24HR();  
    $data['updated_by'] = $_SESSION['ADMIN_USER'];  

    $sql = "UPDATE categories SET cat_code = :cat_code, cat_name = :cat_name, updated_at = :updated_at, updated_by = :updated_by  WHERE cat_id = :cat_id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute($data);  
    $res = $stmt->rowCount();
    $stmt->closeCursor();
    return $res;
}
#region

#region Users
function DeleteUser($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "DELETE FROM users WHERE id= :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);  
    $res = $stmt->rowCount();
    $stmt->closeCursor();
    return $res;

}

function GetUserProfile($user_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "SELECT co.comment, u.first_name, u.last_name, co.created_at, u.picture FROM comments co LEFT JOIN users u ON u.id = co.user_id WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["article_id" => $article_id]);
    $data = $stmt->fetchAll();
    $response = array();
    foreach($data as $comment){
        
        $response[] = array(
            "comment" => $comment['comment'],
            "first_name" => $comment['first_name'],
            "created_at" => $comment['created_at'],
            "last_name" => $comment['last_name'],
            "picture" => $comment['picture'],
        );
    }
    return $response;

}
#endregion

#region Course

function AddCourse($course, $code, $dept) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [
        "dept_code" => $dept,
        "code" => $code,
        "course" => $course,
        "created_by" => $_SESSION['ADMIN_USER'],
        "created_at" => FullDateFormat24HR(),
    ];
    try {
        $sql = "INSERT INTO course (`dept_code`,`code`, `course`, `created_by`, `created_at`) VALUES (:dept_code, :code, :course, :created_by, :created_at)";
        $stmt = $pdo->prepare($sql)->execute($newData);
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
   
}

function GetCourseDetails($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `course` WHERE id = :id");
    $stmt->execute(['id' => $id]); 
    $row = $stmt->fetch();

    $newData = [
        "dept_code" => $row['dept_code'],
        "code" => $row['code'],
        "course" => $row['course'],
        "id" => $row['id'],
    ];

    $stmt->closeCursor();
    return $newData;

}

function GetCourse($dept_code) {

    require_once("connection.php");
    $pdo = Database::getConnection();
    $get_course = [];
    $stmt = $pdo->prepare("SELECT `code`, `course` FROM course WHERE status = 'Y' AND dept_code = :dept_code");
    $stmt->execute(["dept_code" => $dept_code]); 
    while ($row = $stmt->fetch()) {
        $code = $row['code'];
        $name = $row['course'];
        $get_course[] = array("Code" => $code, "Name" => $name);
    }
    $stmt->closeCursor();
    return json_encode($get_course);
}

function UpdateCourse($data) { 
    require_once("connection.php");
    $pdo = Database::getConnection();

    $data['updated_at'] = FullDateFormat24HR();  
    $data['updated_by'] = $_SESSION['ADMIN_USER'];  

    try {
        $sql = "UPDATE `course` SET code = :code,  course = :course, updated_at = :updated_at, updated_by = :updated_by  WHERE id = :id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);  
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function DeleteCourse($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();
    
    $sql = "DELETE FROM course WHERE id= :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);  
    $res = $stmt->rowCount();
    $stmt->closeCursor();
    return $res;

}


#endregion

#region Departments
function GetDepartments() {
    require_once("connection.php");
    $pdo = Database::getConnection();
    
    $stmt = $pdo->prepare("SELECT code, name FROM department WHERE status = 'Y'");
    $stmt->execute(); 
    while ($row = $stmt->fetch()) {
        $code = $row['code'];
        $name = $row['name'];
        $get_depts[] = array("Code" => $code, "Name" => $name);
    }
    $stmt->closeCursor();
    return json_encode($get_depts);
}


function AddDepartment($code, $name) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [
        "code" => $code,
        "name" => $name,
        "created_by" => $_SESSION['ADMIN_USER'],
        "created_at" => FullDateFormat24HR(),
    ];

    try {    
        $sql = "INSERT INTO department (`code`, `name`, `created_by`, `created_at`) VALUES (:code, :name, :created_by, :created_at)";
        $stmt = $pdo->prepare($sql)->execute($newData);
        $stmt->closeCursor();
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}

function GetDepartmentDetails($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();
    
    $newData = [];

    $stmt = $pdo->prepare("SELECT id, code, name FROM `department` WHERE id = :id");
    $stmt->execute(['id' => $id]); 
    $row = $stmt->fetch();

    $newData = [
        "code" => $row['code'],
        "name" => $row['name'],
        "id" => $row['id'],
    ];
    $stmt->closeCursor();
    return $newData;

}
function UpdateDepartment($data) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $data['updated_at'] = FullDateFormat24HR();  
    $data['updated_by'] = $_SESSION['ADMIN_USER'];  

    try {
        $sql = "UPDATE `department` SET code = :code,  name = :name, updated_at = :updated_at, updated_by = :updated_by  WHERE id = :id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);  
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

function DeleteDepartment($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "DELETE FROM department WHERE id= :id";
    $stmt= $pdo->prepare($sql);
    $stmt->execute(["id" => $id]);  
    $res = $stmt->rowCount();
    $stmt->closeCursor();
    return $res;
}
#endregion

#region UserConfig

function UpdateStudentConfig($data) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $data['modified'] = FullDateFormat24HR();  
    $data['isconfig'] = "Y";  

    try {
        
        $sql = "UPDATE `users` SET         
                    `reference_id` = :reference_id, `first_name` = :first_name, `last_name` = :last_name, 
                    `gender` = :gender, `course_code` = :course_code, 
                    `department_code` = :department_code, `contact_number` = :contact_number, 
                    `modified` = :modified, `isconfig` = :isconfig
                WHERE oauth_uid = :oauth_uid";

        $stmt= $pdo->prepare($sql);
        $stmt->execute($data);  
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}

#endregion

#region Search
function SearchArticles($keyword, $Date1, $Date2) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $numberofrecords = 10;
    // $stmt = $pdo->prepare("SELECT * FROM articles WHERE keyword like :keyword AND created_at BETWEEN :Date1 AND :Date2 ORDER BY id LIMIT :limit");

    $stmt = $pdo->prepare("SELECT al.art_id, art.title FROM `author_list` al 
    LEFT JOIN users u ON u.id = al.user_id 
    LEFT JOIN articles art ON art.id = al.art_id 
    WHERE u.first_name LIKE :fname or u.last_name LIKE :lname or art.keyword LIKE :keyword
    AND art.created_at BETWEEN :Date1 AND :Date2 AND art.status = 'Y'
    GROUP BY al.art_id ORDER BY art.id LIMIT :limit");

	
    $stmt->bindValue(':fname', '%'.$keyword.'%', PDO::PARAM_STR);
    $stmt->bindValue(':lname', '%'.$keyword.'%', PDO::PARAM_STR);
    $stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
    $stmt->bindValue(':Date1', $Date1, PDO::PARAM_STR);
    $stmt->bindValue(':Date2', $Date2, PDO::PARAM_STR);
	$stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
	$stmt->execute();
	$usersList = $stmt->fetchAll();

    $response = array();
    
    foreach($usersList as $user){
        $response[] = array(
            "id" => $user['art_id'],
            "text" => $user['title']
        );
    }
    
    return json_encode($response);
}

function GetSearchArticleByID($id, $isAll) {

    require_once("connection.php");
    $pdo = Database::getConnection();  

    if( $isAll) {
        $sql = "SELECT * FROM articles WHERE status = 'Y' ORDER BY created_at DESC LIMIT 10";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    } else {
        $in  = str_repeat('?,', count($id) - 1) . '?';
        $sql = "SELECT * FROM articles WHERE status = 'Y' AND id IN ($in)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute($id);
    } 

    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;

}

function GetAuthors($art_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();
    $newData = [];
    $stmt = $pdo->prepare("SELECT al.id as alID, u.id as user_id, u.first_name, u.last_name, u.picture 
                            FROM author_list al LEFT JOIN users u ON al.user_id = u.id WHERE art_id = :art_id");
    $stmt->execute(['art_id' => $art_id]); 
    $authorList = $stmt->fetchAll();

    $response = array();

    foreach($authorList as $authors){
        $response[] = array(
            "alID" => $authors['alID'],
            "user_id" => $authors['user_id'],
            "first_name" => $authors['first_name'],
            "last_name" => $authors['last_name'],
            "picture" => $authors['picture'],
        );
    }
    
    return $response;

}

function GetUserFullName($userID){

    require_once("connection.php");
    $pdo = Database::getConnection();
    $stmt = $pdo->prepare("SELECT id, first_name, last_name, picture FROM `users` WHERE id = :userID");
    $stmt->execute(['userID' => $userID]); 
    $user_details = $stmt->fetchAll();

    $response = array();

    foreach($user_details as $user){
        $response[] = array(
            "user_id" => $user['id'],
            "first_name" => $user['first_name'],
            "last_name" => $user['last_name'],
            "picture" => $user['picture'],
        );
    }

    return $response;
}

function CheckUserAccess($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT * FROM `article_access` WHERE art_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
    $row = $stmt->rowCount();
    return $row;
}

function GenerateUserAccess($art_id) {
    $isNew = false;
    if(CheckUserAccess($art_id) == 0) {
        require_once("connection.php");
        $pdo = Database::getConnection();  
        $sql = "INSERT INTO article_access (`art_id`, `user_id`) VALUES (:art_id, :user_id)";
        $stmt = $pdo->prepare($sql)->execute(["art_id" => $art_id, "user_id" => $_SESSION['USER_ID']]);
        $isNew = true;
    }
    return $isNew;
}

function CheckUserAccessStatus($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT * FROM `article_access` WHERE art_id = :art_id AND user_id = :user_id AND status = 'Y'");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
    $row = $stmt->rowCount();
    return $row;
}
#endregion

#region Post
function SearchAuthors($keyword) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $numberofrecords = 10;
    $stmt = $pdo->prepare("SELECT * FROM users WHERE isconfig = 'Y' AND first_name LIKE :keyword or last_name LIKE :keyword LIMIT :limit");
	
    $stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
	$stmt->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
	$stmt->execute();
	$usersList = $stmt->fetchAll();

    $response = array();

    foreach($usersList as $user){
        $response[] = array(
            "id" => $user['id'],
            "text" => $user['first_name'] . ' ' .$user['last_name'] 
        );
    }
    
    return json_encode($response);
}

function AddPost($postDetails, $authorList) {
    require_once("connection.php");
    $pdo = Database::getConnection();
    $isSuccess = false;
    try {

        $postDetails['created_at'] = FullDateFormat24HR();  
        $postDetails['main_author_id'] = $_SESSION['USER_ID'];  

        $sql = "INSERT INTO articles 
                    (`title`, `dept_code`, `cat_code`, `content`, `file`, `availability`, `main_author_id`, `keyword`, `created_at`) 
                VALUES 
                    (:title, :dept_code, :cat_code, :content, :file, :availability, :main_author_id, :keyword, :created_at)";                  
        
        $stmt = $pdo->prepare($sql);
        $pdo->beginTransaction();
        $stmt->execute($postDetails);
        $lastID = $pdo->lastInsertId();
        $pdo->commit();
        AddAuthorList($pdo, $lastID, $authorList, $_SESSION['USER_ID']);
        $isSuccess = true;
    } catch(PDOExecption $e) {
        $isSuccess = false;
        $pdo->rollback();
        print "Error!: " . $e->getMessage() . "</br>";
    }
    return $isSuccess;
}

function AddAuthorList($pdo, $art_id, $authorList, $main_author) {

    if(!in_array( $main_author ,$authorList ) ) {
        array_push($authorList, ["id" => $main_author]);
    }    
        
    foreach($authorList as $authors){
         $sql = "INSERT INTO author_list (`art_id`, `user_id`) VALUES (:art_id, :user_id);";
         $stmt = $pdo->prepare($sql);
         $pdo->beginTransaction();
         $stmt->execute(["art_id" => $art_id, "user_id" => $authors['id']]);
         $pdo->commit();
    }

    AddNotification("NEW ARTICLE", $art_id);
 
}


#endregion

#region ApprovePost
function ApprovePost($id) {

    require_once("connection.php");
    $pdo = Database::getConnection();

    try {
        $sql = "UPDATE `articles` SET status = 'Y',  updated_at = :updated_at WHERE id = :id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(["id" => $id, "updated_at" => FullDateFormat24HR()]);  
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
function DisapprovePost($id) {
    
    require_once("connection.php");
    $pdo = Database::getConnection();

    try {
        $sql = "UPDATE `articles` SET status = 'D',  updated_at = :updated_at WHERE id = :id";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(["id" => $id, "updated_at" => FullDateFormat24HR()]);  
        $res = $stmt->rowCount();
        $stmt->closeCursor();
        return $res;
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}
#endregion

#region ViewArticle
function GetArticleCommentCount($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM `comments` WHERE article_id = :art_id");
    $stmt->execute(['art_id' => $art_id]); 
    $row = $stmt->fetchcolumn();
    return $row;
    
}

function GetArticleLikes($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM `no_likes` WHERE article_id = :art_id");
    $stmt->execute(['art_id' => $art_id]); 
    $row = $stmt->fetchcolumn();
    return $row;
    
}

function GetArticleDislikes($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM `dislikes` WHERE article_id = :art_id");
    $stmt->execute(['art_id' => $art_id]); 
    $row = $stmt->fetchcolumn();
    return $row;
    
}

//LIKES
function LikeArticle($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    UndislikeArticle($art_id);
    UnlikeArticle($art_id);

    $stmt = $pdo->prepare("INSERT INTO `no_likes` (article_id, user_id) VALUES (:art_id, :user_id)");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 

    return GetArticleLikes($art_id);
}

function UnlikeArticle($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("DELETE FROM no_likes WHERE article_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 

    return GetArticleLikes($art_id);  
}

function CheckIfUserLikes($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM `no_likes` WHERE article_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
    $row = $stmt->fetchcolumn();
    return $row;
}
//DISLIKES
function DislikeArticle($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    UnlikeArticle($art_id);
    UndislikeArticle($art_id);
      
    $stmt = $pdo->prepare("INSERT INTO `dislikes` (article_id, user_id) VALUES (:art_id, :user_id)");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
    
    return GetArticleDislikes($art_id);  
}

function UndislikeArticle($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("DELETE FROM dislikes WHERE article_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
   
    return GetArticleDislikes($art_id);  
}

function CheckIfUserDislikes($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM `dislikes` WHERE article_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 
    $row = $stmt->fetchcolumn();
    return $row;
}

function GetArticleComments($article_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();  
    
    $sql = "SELECT co.comment, u.first_name, u.last_name, co.created_at, u.picture FROM comments co LEFT JOIN users u ON u.id = co.user_id WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["article_id" => $article_id]);
    $data = $stmt->fetchAll();
    $response = array();
    foreach($data as $comment){
        
        $response[] = array(
            "comment" => $comment['comment'],
            "first_name" => $comment['first_name'],
            "created_at" => $comment['created_at'],
            "last_name" => $comment['last_name'],
            "picture" => $comment['picture'],
        );
    }
    return $response;

}

function PostComment($art_id, $comment) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $postDate = FullDateFormat24HR();
    $postData = [
        'art_id' => $art_id, 
        "user_id" => $_SESSION['USER_ID'],
        "comment" => $comment,
        "created_at" => $postDate
    ];
      
    $stmt = $pdo->prepare("INSERT INTO `comments` (article_id, user_id, comment, created_at) VALUES (:art_id, :user_id, :comment, :created_at)");
    $stmt->execute($postData); 

    
    return GetArticleComments($art_id);
    
}

function GetRateRatio($article_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  
   
    $sql = " SELECT (SUM(rate_val) / SUM(rate_base) * 5) as RateRatio FROM ratings WHERE article_id = :article_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["article_id" => $article_id]);
    $data = $stmt->fetchcolumn(); 
    return $data ;
}

function RateArticle($art_id, $rating) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $postDate = FullDateFormat24HR();
    $postData = [
        'art_id' => $art_id, 
        "user_id" => $_SESSION['USER_ID'],
        "rate_val" => $rating,
        "created_at" => $postDate
    ];

    $sql = "SELECT id FROM ratings WHERE article_id = :article_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["article_id" => $art_id, "user_id" => $_SESSION['USER_ID']]);
    $data = $stmt->fetchcolumn(); 

    if($data > 0) {
        $stmt = $pdo->prepare("UPDATE `ratings` SET rate_val = :rate_val WHERE article_id = :article_id AND user_id = :user_id");
        $stmt->execute(["rate_val" => $rating, "article_id" => $art_id, "user_id" => $_SESSION['USER_ID']]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO `ratings` (article_id, user_id, rate_val, created_at) VALUES (:art_id, :user_id, :rate_val, :created_at)");
        $stmt->execute($postData);
    }
    
    return GetRateRatio($art_id);
    
}
function GetUserArticleRating($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection(); 
    $sql = "SELECT rate_val FROM ratings WHERE article_id = :article_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["article_id" => $art_id, "user_id" => $_SESSION['USER_ID']]);
    $data = $stmt->fetchcolumn(); 
    return $data;
}

function UpdateArticleViewCount($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection(); 
    $stmt = $pdo->prepare("INSERT INTO `article_views` (`article_id`, `user_id`, `created_at`) VALUES (:art_id, :user_id, :created_at)");
    $stmt->execute(["art_id" => $art_id, "user_id" => $_SESSION['USER_ID'], "created_at" => FullDateFormat24HR()]);
}
#endregion


#region Request
function GetSearchArticleByIDPending() {

    require_once("connection.php");
    $pdo = Database::getConnection();  

    $sql = "SELECT art.* FROM article_access ac LEFT JOIN articles art ON art.id = ac.art_id
            WHERE ac.status = 'N' AND ac.user_id =  :user_id
            ORDER BY art.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['user_id' => $_SESSION['USER_ID']]);

    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;

}

function CancelRequest($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("DELETE FROM article_access WHERE art_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $_SESSION['USER_ID']]); 

}

#endregion

#region Profile
function GetUserStudentProfile($user_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "SELECT u.first_name as FirstName, u.last_name as LastName, cs.course as Course, dept.name as Department, u.picture, u.user_role,
    u.email as EmailAdd, u.contact_number as Contact, COUNT(art.id) as TotalArticles, (SUM(rt.rate_val) / SUM(rt.rate_base) * 5) as RateRatio
    FROM users as u 
    LEFT JOIN course cs on cs.code = u.course_code
    LEFT JOIN department dept on dept.code = u.department_code
    LEFT JOIN articles as art on art.main_author_id = u.id AND art.status = 'Y'
    LEFT JOIN ratings as rt on rt.article_id = art.id AND rt.user_id = u.id
    LEFT JOIN no_likes nl on nl.user_id = u.id
    LEFT JOIN dislikes dl on dl.user_id = u.id
    WHERE u.isconfig = 'Y' AND u.id = :user_id
    GROUP BY u.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);
    $data = $stmt->fetchAll();
    $response = array();
    foreach($data as $profile){
        
        $response[] = array(
            "FirstName" => $profile['FirstName'],
            "LastName" => $profile['LastName'],
            "Role" => $profile['user_role'],
            "course" => $profile['Course'],
            "department" => $profile['Department'],
            "emailadd" => $profile['EmailAdd'],
            "contact" => $profile['Contact'],
            "totalpost" => $profile['TotalArticles'],
            "picture" => $profile['picture'],
            "totalratings" => $profile['RateRatio'],
            "totallikes" => GetCurrentUserLikes($user_id),
            "totaldislikes" => GetCurrentUserDislikes($user_id),
        );
    }
    return $response;
}

function GetCurrentUserLikes($user_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();  
    $stmt = $pdo->prepare("SELECT COUNT(user_id) FROM no_likes WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]); 
    $row = $stmt->fetchcolumn();
    return $row;

}

function GetCurrentUserDislikes($user_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();  
    $stmt = $pdo->prepare("SELECT COUNT(user_id) FROM dislikes WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $user_id]); 
    $row = $stmt->fetchcolumn();
    return $row;

}
function GetUserStudentProfileForForm($user_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "SELECT u.first_name as FirstName, u.last_name as LastName, u.course_code as Course, u.department_code as Department, u.picture, u.user_role,
    u.email as EmailAdd, u.contact_number as Contact, u.gender , u.reference_id
    FROM users as u 
    WHERE u.isconfig = 'Y' AND u.id = :user_id
    GROUP BY u.id";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);
    $data = $stmt->fetchAll();
    $response = array();
    foreach($data as $profile){
             
        $response[] = array(
            "reference_id" => $profile['reference_id'],
            "FirstName" => $profile['FirstName'],
            "LastName" => $profile['LastName'],
            "Role" => $profile['user_role'],
            "course" => $profile['Course'],
            "department" => $profile['Department'],
            "emailadd" => $profile['EmailAdd'],
            "contact" => $profile['Contact'],
            "picture" => $profile['picture'],
            "gender" => $profile['gender'],
        );
    }
    return $response;
}
function UpdateUserProfile($data) {

    $data['user_id'] = $_SESSION['USER_ID'];


    require_once("connection.php");
    $pdo = Database::getConnection(); 

    $updateProfile = "";
    if(isset($data['picture'])) {
        $updateProfile = "picture = :picture,";
    }

    $sql = "UPDATE users SET reference_id = :reference_id, first_name = :first_name,
            last_name = :last_name, last_name = :last_name, gender = :gender,
            course_code  = :course ,department_code  = :dept, $updateProfile contact_number  = :contact 
        WHERE id = :user_id";

    $stmt = $pdo->prepare($sql);

    $stmt->execute($data);

    $_SESSION['USER_FIRST'] = $data['first_name'];
    $_SESSION['USER_LAST'] = $data['last_name'];   

    if(isset($data['picture'])) {
        $_SESSION['USER_PICTURE'] = $data['picture']; 
    }


}

function GetRequestArticle($user_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();  
 
    $sql = "SELECT art.id, u.id as user_id, art.title, u.first_name, u.last_name, u.picture, acc.requested_at FROM article_access acc 
            LEFT JOIN articles art on art.id = acc.art_id
            LEFT JOIN users u ON u.id = acc.user_id
            WHERE art.main_author_id = :user_id AND acc.status = 'N'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);

    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;

}

function AcceptRequest($user_id, $art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("UPDATE article_access SET status = 'Y' WHERE art_id = :art_id AND user_id = :user_id");
    $stmt->execute(['art_id' => $art_id, "user_id" => $user_id]); 

}

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}

function GetChartData($user_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  


    $dateRange = getDatesFromRange(date('Y-m-d', strtotime('-6 days')), date("Y-m-d"));

    $response = array();
    foreach($dateRange as $dates){
        
        $date = date_create($dates);

        $stmt = $pdo->prepare("SELECT COUNT(nl.id) as LIKES FROM author_list au 
                                LEFT JOIN articles art ON art.id = au.art_id LEFT JOIN no_likes nl ON nl.article_id = art.id
                                WHERE au.user_id = :user_id AND DATE(nl.created_at) = :created_at");
        $stmt->execute(["created_at" => $dates, "user_id" => $user_id]); 
        $TotalLikes = $stmt->fetchcolumn();
    
        $stmt = $pdo->prepare("SELECT COUNT(dl.id) as TotalDislikes FROM author_list au 
                                LEFT JOIN articles art ON art.id = au.art_id LEFT JOIN dislikes dl ON dl.article_id = art.id
                                WHERE au.user_id = :user_id  AND DATE(dl.created_at) = :created_at");
        $stmt->execute(["created_at" => $dates, "user_id" => $user_id]); 
        $TotalDislikes = $stmt->fetchcolumn();
    
        $stmt = $pdo->prepare("SELECT COUNT(com.id) as TotalComments FROM author_list au 
                                LEFT JOIN articles art ON art.id = au.art_id LEFT JOIN comments com ON com.article_id = art.id
                                WHERE au.user_id = :user_id  AND DATE(com.created_at) = :created_at");
        $stmt->execute(["created_at" => $dates, "user_id" => $user_id]); 
        $TotalComments = $stmt->fetchcolumn();
    
        $stmt = $pdo->prepare("SELECT COUNT(art.article_id) as TotalViews FROM author_list au 
                                LEFT JOIN article_views art ON art.article_id = au.art_id 
                                WHERE au.user_id = :user_id  AND DATE(art.created_at) = :created_at ");
        $stmt->execute(["created_at" => $dates, "user_id" => $user_id]); 
        $TotalViews = $stmt->fetchcolumn();

        $response[] = array(
            "date" => date_format($date,"M d, Y"),
            "likes" => $TotalLikes,
            "dislikes" => $TotalDislikes,
            "comments" => $TotalComments,
            "views" => ($TotalViews == null ? 0 : $TotalViews),
        );
    }
    return $response;
}
#endregion

#region SaveList
function SaveArticle($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  
    $sql = "SELECT id FROM save_list WHERE art_id = :art_id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["art_id" => $art_id, "user_id" => $_SESSION['USER_ID']]);
    $data = $stmt->fetchcolumn(); 

    if($data < 1) {
        $postData = [
            'art_id' => $art_id, 
            "user_id" => $_SESSION['USER_ID'],
        ];
        $stmt = $pdo->prepare("INSERT INTO `save_list` (art_id, user_id) VALUES (:art_id, :user_id)");
        $stmt->execute($postData);
    }

}

function GetTotalReads($art_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();
   
    $sql = "SELECT COUNT(id) as ViewCount FROM article_views WHERE article_id = :art_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["art_id" => $art_id]);
    $data = $stmt->fetchcolumn(); 
    return $data;
}

function GetPostandReads($user_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "SELECT art.id as ArticleID FROM articles art WHERE art.main_author_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);
    $data = $stmt->fetchAll();
    $response = array();

    $totalPost = 0;
    $totalReads = 0;
    foreach($data as $profile){
        $totalPost += 1;
        $totalReads += GetTotalReads($profile['ArticleID']);
    }

    $response[] = array(
        "totalpost" => $totalPost,
        "totalreads" => $totalReads,
    );

    return $response;

}

function GetSavedArticle($user_id) {

    require_once("connection.php");
    $pdo = Database::getConnection();  
 
    $sql = "SELECT art.* FROM `save_list` sl LEFT JOIN articles art on art.id = sl.art_id WHERE sl.user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);

    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;

}


#endregion
#region Categories
function AddAnnouncements($data) {

    require_once("connection.php");
    $pdo = Database::getConnection();
    $sql = "SELECT id FROM announcement WHERE id = 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchcolumn(); 
    $data['created_at'] = FullDateFormat24HR();

    try {
        if($result < 1) {  
            $stmt = $pdo->prepare("INSERT INTO `announcement` (`title`, `description`, `filename`, `attachment`, `created_at`) VALUES (:title, :description, :filename, :attachment, :created_at)");
            $stmt->execute($data);
        } else {
            $stmt = $pdo->prepare("UPDATE `announcement` SET title = :title, description = :description, filename = :filename, attachment = :attachment, created_at = :created_at WHERE id = 1");
            $stmt->execute($data);
        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}

function RetrieveAnnouncement() {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $sql = "SELECT * FROM announcement WHERE id = 1";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll();
    $response = array();

    foreach($data as $announcement){
        
        $response[] = array(
            "title" => $announcement['title'],
            "description" => $announcement['description'],
            "filename" => $announcement['filename'],
            "attachment" => $announcement['attachment'],
        );
    }
    return $response;
    
}

function ViewAnnouncement() {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $newData = [];

    $stmt = $pdo->prepare("SELECT * FROM `announcement`");
    $stmt->execute(); 
    $row = $stmt->fetch();

    $newData = [
        "title" => $row['title'],
        "description" => $row['description'],
        "filename" => $row['filename'],
        "created_at" => $row['created_at'],    
    ];

    $stmt->closeCursor();
    return $newData;
}
#endregion
#region Recommendation
function Recommendations() {

    require_once("connection.php");
    $pdo = Database::getConnection();  

    $sql = "SELECT art.*, (SUM(rt.rate_val) / SUM(rt.rate_base) * 5) as Rate, (SELECT COUNT(id) FROM no_likes WHERE article_id = art.id) as Likes, (SELECT COUNT(id) FROM dislikes WHERE article_id = art.id) as DisLikes FROM articles art 
    LEFT JOIN ratings rt ON rt.article_id = art.id
    WHERE art.status = 'Y' AND art.availability IN ('PUB','BOTH')
    GROUP BY art.id
    ORDER BY Rate DESC LIMIT 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;

}
#endregion


#region Recommendation
function AddNotification($action, $art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $toNotiflist = FetchUserToNotif($art_id);
    
    foreach($toNotiflist as $notify) {
        $data = [
            "type" => $action,
            "to_user_id" => $notify['user_id'],
            "from_user_id" => $_SESSION['USER_ID'],
            "created_at" => FullDateFormat24HR(),
        ];

        if($notify['user_id'] !== $_SESSION['USER_ID']) {
            $stmt = $pdo->prepare("INSERT INTO `notification` (`type`, `to_user_id`, `from_user_id`, `created_at`) VALUES (:type, :to_user_id, :from_user_id, :created_at)");
            $stmt->execute($data);
        }
       
    }
}

function FetchUserToNotif($art_id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $sql = "SELECT user_id FROM author_list WHERE art_id = :art_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["art_id" => $art_id]);
    $data = $stmt->fetchAll();
    return $data;
}

function GetNotification() {
    require_once("connection.php");
    $pdo = Database::getConnection();  
    $sql = "SELECT id, type, created_at FROM notification WHERE to_user_id = :user_id AND status = 'N' ORDER by created_at DESC LIMIT 15";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["user_id" => $_SESSION['USER_ID']]);
    $data = $stmt->fetchAll();
    $stmt->closeCursor();
    return $data;
}

function SeenNotification($id) {
    require_once("connection.php");
    $pdo = Database::getConnection();  

    $stmt = $pdo->prepare("UPDATE notification SET status = 'Y' WHERE id = :id");
    $stmt->execute(["id" => $id]);     
}

function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}
#endregion

#region Dashboard
function GetDashTotals() {
    require_once("connection.php");
    $pdo = Database::getConnection();

    $response = array();

    $stmt = $pdo->prepare("SELECT COUNT(id) as PendingPost FROM articles WHERE status = 'N'");
    $stmt->execute(); 
    $PendingPost = $stmt->fetchcolumn();

    $stmt = $pdo->prepare("SELECT COUNT(id) as TotalLikes FROM no_likes");
    $stmt->execute(); 
    $TotalLikes = $stmt->fetchcolumn();

    $stmt = $pdo->prepare("SELECT COUNT(id) as TotalDislikes FROM dislikes");
    $stmt->execute(); 
    $TotalDislikes = $stmt->fetchcolumn();

    $stmt = $pdo->prepare("SELECT (COUNT(id) / DATEDIFF(CURRENT_DATE(), (SELECT created_at FROM articles order by created_at desc limit 1))) AS days FROM articles");
    $stmt->execute(); 
    $AveratePostRate = $stmt->fetchcolumn();

    $stmt = $pdo->prepare("SELECT COUNT(id) FROM article_views");
    $stmt->execute(); 
    $PostViews = $stmt->fetchcolumn();

    $response[] = array(
        "totalpending" => $PendingPost,
        "totallikes" => $TotalLikes,
        "totaldislikes" => $TotalDislikes,
        "averagerate" => $AveratePostRate == null ? 0 : $AveratePostRate,
        "totalpostviews" => $PostViews,
        "totalcitations" => 0,
    );
    
    return $response;

}
#endregion
?>