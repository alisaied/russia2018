<?php 

 session_start();
 
 session_unset();
 
 session_destroy();
 // Redirect to homepage edited 2
 // updated in branch 01
 header ('location:index.php');
 
 exit();
 
 

?>
 