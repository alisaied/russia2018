<?php  
error_reporting(0);
ob_start(); 
session_start();

if (isset($_SESSION['username']) && $_SESSION['username']!="") {
	
		header ('location:dashboard');
	
	}
 
else {
include('head.php');

 ?>

<body>
<?php include('navbar.php'); ?>
<div class="container col-sm-12  col-md-6">

 <br>
 
 
 <div class="alert alert-info text-center"><h3>Please log in or sign up for a new account</h3></div>
  <div class="form-group row">
    <label for="username" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" placeholder="Username" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="password" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
  </div>
  
  
  <div class="form-group row">
    <div class="col-sm-2 " >
      <button id="login" name="login" class="btn btn-primary login-btn">Log in</button>
    </div>
    <div class="col-sm-10 col-xs-10">
    <div id="statusMsg" class="alert " role="alert">  </div>
</div>
  </div>
</div>  


<!-------------------------------------------->


<?php include("scripts.php"); ?>
						
<script type="text/javascript">  

	 
$(document).on('click', '.login-btn', function(event){  
event.preventDefault();

					 $ . ajax( {
					 			type: "POST",
					 			url: "ajax.php",
					 			data: {
									op:'login',
					 				username: $('#username').val(),
					 				password: $('#password').val()
					 			},
					 			success: function ( response ) {

					 					//$('#statusMsg').html('Response Msg : '+response);

					 					if ( $ . trim( response ) == "false" ) {
					 						$( '#statusMsg' ) . addClass( "alert-danger" );
					 						$( '#statusMsg' ) . html( 'Invalid Username or Password' );


					 					}
					 					if ( $ . trim( response ) == "true" ) {
							$('#statusMsg').removeClass("alert-danger");
							$('#statusMsg').addClass("alert-success");	 
							$('#statusMsg').html('Sign in successfully, Redirecting to Dashboard');
						
			setTimeout( function(){window.location = "dashboard"; }, 3 );	
										
								  
									}
									
		
								
							}
			
 	
					 }); 
					 //return false;

				 
		});

$(document).on('keydown', '#password', function(e){
   if(e.keyCode == 13){
    $('.login-btn').trigger('click');
   }
});

</script> <!-- Login Ajax Scripts -->


</body>
</html>
<?php 
}

ob_end_flush(); 
?>