<?php 
/* 
 * User Class 
 * This class is used for database related (connect, insert, and update) operations 
 * @author    CodexWorld.com 
 * @url        http://www.codexworld.com 
 * @license    http://www.codexworld.com/license 
 */ 
 
class User { 
    private $dbHost     = DB_HOST; 
    private $dbUsername = DB_USER; 
    private $dbPassword = DB_PASSWORD; 
    private $dbName     = DB_NAME; 
    private $userTbl    = "users"; 

    function __construct(){ 
        if(!isset($this->pdo)){ 
            // Connect to the database 
            try {
                $conn = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUsername, $this->dbPassword);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $conn; 
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        } 
    } 
     
    function checkUser($data){ 
        if(!empty($data)){ 

            $userRole = (strpos($data->email, 'my.jru.edu') ? 'Student' : 'Others');

            $checkQuery = "SELECT * FROM $this->userTbl WHERE oauth_uid = :oauth_uid";
            $stmt = $this->pdo->prepare($checkQuery);
            $stmt->execute(['oauth_uid' => $data->id]); 
            $user = $stmt->fetchColumn();
            $stmt->closeCursor();

            $newData = [
                "oauth_uid" => $data->id,
                "first_name" => $data->givenName,
                "last_name" => $data->familyName,
                "email" => $data->email,
                "gender" => $data->gender,
                "picture" => $data->picture,
                "created_at" => date("Y-m-d H:i:s")
            ];

            if($user < 1){                 
           
                $newData['user_role'] = $userRole;  
                $sql = "INSERT INTO $this->userTbl
                            (
                                `oauth_uid`, `user_role`, `first_name`, 
                                `last_name`, `email`, `gender`, `picture`, `created_at`
                            ) 
                        VALUES 
                            (
                                :oauth_uid, :user_role, :first_name, 
                                :last_name, :email, :gender, :picture, :created_at
                            )";

                $this->pdo->prepare($sql)->execute($newData);
                $newData['user_id'] = $this->pdo->lastInsertId();
            } else {

                $stmt = $this->pdo->prepare($checkQuery);
                $stmt->execute(['oauth_uid' => $data->id]); 
                $row = $stmt->fetch();           
                $newData['user_role'] = $row['user_role'];  
                $newData['isconfig'] = $row['isconfig'];  
                $newData['user_id'] = $row['id'];  
            }
             
            // Get user data from the database 
            $result = $newData;
        } 
         
        // Return user data 
        return !empty($result)? $result : false; 
    } 
}