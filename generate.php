<?php 
error_reporting(0);
ob_start();
session_start();

if (isset($_SESSION['username']) && $_SESSION['username'] =="admin") {
	
include('dll.php');
include "head.php"; 
$user = getUserById($_SESSION['id']);



?>
<body>
<?php include "navbar.php"; ?>
<div class="container">
<br>
<?php 
if (isset($_POST['amount']) && isset($_POST['qty'])) {
 	
	$result=0;
	
	for($i=0; $i<$_POST['qty']; $i++){
		$result+=generatePINs($_POST['amount']);
	}
 
	$msg='<h3 class="alert alert-success">'.$result.' Prepaid card have been created succefully</h3>';
	
 	
 }  // 
 ?>
<div class="row  ">
<div class="col-6">
<form class="shadow p-3  bg-white rounded" id="generateFrm" action="generate.php" method="post" >
	  <div class="form-group row">
		<label for="amount" class="col-sm-5 col-form-label">Card Amount</label> 
		<div class="col-sm-7">
		  <input id="amount" name="amount" placeholder="Card Amount" type="number" class="form-control " required="required"  >
		</div>
	  </div>
	  <div class="form-group row">
		<label for="qty" class="col-sm-5 col-form-label">Number of Cards </label> 
		<div class="col-sm-7">
		  <input id="qty" name="qty" placeholder="Number of Cards" type="number" class="form-control " required="required"  >
		</div>
	  </div>

	  <div class="form-group row ">
		<div class="col-12 col-sm-5">
		  <button id="generate"  name="generate" class="btn btn-primary " >Generate</button>
		</div>
	  </div>
	  
	</form>
</div>
<?php

	echo $msg;
	
?>
	
</div>

</div>
 

<?php include("scripts.php"); ?>

<script>

$( document ).ready(function() {
	
	swal({title: 'Error!',text: <?php echo $msg; ?>,type: 'error',confirmButtonText: 'OK'})
    	
});

$(document).on('click', '#generate', function(){
		event.preventDefault();
			
		if($('#amount').val() == "" || $('#qty').val() == "" ){
			swal({title: 'Error!',text: 'Please input all required fields',type: 'error',confirmButtonText: 'OK'}) 
			return;
		}
		$('#generateFrm').submit();	


		
	});

</script>

<?php  
}else{
header ('location:login');
} ?>
</body>
</html>

<?php 
ob_end_flush(); 		
?>