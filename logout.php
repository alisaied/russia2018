<?php 

 session_start();
 
 session_unset();
 
 session_destroy();
 // Redirect to homepage edited
 header ('location:index.php');
 
 exit();
 
 

?>
 