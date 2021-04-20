<?php 
ob_start();
session_start();
// Report all errors
error_reporting(0); // 0  off all


?>


<body>
  <?php   
  if (isset($_SESSION['username']) && $_SESSION['username']!="")
  	header ('location:dashboard');
  else
	header ('location:login');
	
  
  ?>


<script type="text/javascript">
  

$("#shareRoundIcons").jsSocials({
    showLabel: false,
    showCount: false,
    shares: ["facebook", "twitter", "googleplus","linkedin","email", "pinterest", "stumbleupon"]
});


</script>

  
  
  
</body>
</html>
<?php 
ob_end_flush(); 		
?>