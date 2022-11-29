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
    $stmt = $pdo->prepare("SELECT * FROM users WHERE first_name LIKE :keyword or last_name LIKE :keyword LIMIT :limit");
	
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

?>