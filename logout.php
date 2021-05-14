<?php 

 session_start();
 
 session_unset();
 
 session_destroy();
 // Redirect to homepage edited 2
 header ('location:index.php');
 
 exit();
 
 

?>
 