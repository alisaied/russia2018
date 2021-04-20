<?php 

$dns = 'mysql:host=localhost;dbname=russia2018';
$user = 'root';
$password = '';
$option = array(

PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);

try {
	
$connection = new PDO($dns,$user,$password,$option);	
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	
	
}

catch(PDOException $e) {
	
	echo 'DB connection error: ' .$e->getMessage(); 
	
	}
	

?>
 
 
