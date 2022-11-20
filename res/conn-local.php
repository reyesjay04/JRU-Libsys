<?php ob_start();
/*
 * Basic Site Settings and API Configuration
 */

// Database configuration

define('DB_NAME', 'jrurepo');
define('DB_USER', 'jruuser');
define('DB_PASSWORD', 'jruuser');
define('DB_HOST', 'localhost'); 

try {
  $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
  // set the PDO error mode to exception
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

function ConnectionArray() {
	return $dbDetails = array('host' => DB_HOST, 'user' => DB_USER, 'pass' => DB_PASSWORD, 'db' => DB_NAME);
}  

?>

