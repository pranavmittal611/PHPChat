<?php
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'password');
try{
	$pdo = new PDO('mysql:host=localhost;dbname=phpchat;charset=utf8mb4', DB_USERNAME, DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
	die('ERROR: Could not connect. ' . $e->getMessage());
}
?>