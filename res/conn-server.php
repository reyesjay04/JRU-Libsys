<?php

define('DB_HOST', 'localhost'); 
define('DB_USER', 'jrurepo');
define('DB_PASSWORD', 'password2022');
define('DB_NAME', 'jrurepo');

try {
  $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


?>

