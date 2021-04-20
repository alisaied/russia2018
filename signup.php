<?php 
error_reporting(0);
ob_start();
session_start();
include('dll.php');
include "head.php"; 

?>
<body>
<?php include "navbar.php"; ?>
<div class="container">
<br>
<div class="row p-2 m-2 justify-content-center">
<form class="shadow p-4 m-4 bg-white rounded profile">
	  <div class="form-group row">
		<label for="firstname" class="col-sm-4 col-form-label">First Name</label> 
		<div class="col-sm-8">
		  <input id="firstname" name="firstname" placeholder="First Name" type="text" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="lastname" class="col-sm-4 col-form-label">Last Name</label> 
		<div class="col-sm-8">
		  <input id="lastname" name="lastname" placeholder="Last Name" type="text" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="username" class="col-sm-4 col-form-label">Username</label> 
		<div class="col-sm-8">
		  <input id="username" name="username" placeholder="Username" type="text" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="password" class="col-sm-4 col-form-label">Password</label> 
		<div class="col-sm-8">
		  <input id="password" name="password" placeholder="Password" type="password" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="confirmPassword" class="col-sm-4 col-form-label">Confirmation</label> 
		<div class="col-sm-8">
		  <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" type="password" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="email" class="col-sm-4 col-form-label">Email</label> 
		<div class="col-sm-8">
		  <input id="email" name="email" placeholder="Email" type="text" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="phone" class="col-sm-4 col-form-label">Telephone</label> 
		<div class="col-sm-8">
		  <input id="phone" name="phone" placeholder="Telephone" type="text" class="form-control ">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="address" class="col-sm-4 col-form-label">Address</label> 
		<div class="col-sm-8">
		  <input id="address" name="address" placeholder="Address" type="text" class="form-control ">
		</div>
	  </div>

	  <div class="form-group row ">
		<div class="col-12 col-sm-4">
		  <button id="signup"  name="signup" class="btn btn-primary signup">Create Account</button>
		</div>
	  </div>
	  <input type="hidden" id="accountid" value="0" name="accountid">
	</form>

</div>
</div>
 

<?php include("scripts.php"); ?>

<script>



function doSignup(){

		if($('#firstname').val() == "" || $('#lastname').val() == "" || $('#username').val()== "" || $('#password').val()== "" )
			{
				
				swal({title: 'Error!',text: 'Please input required fields',type: 'error',confirmButtonText: 'OK'
					}) 	
				return;
			}
		if ($('#password').val() != $('#confirmPassword').val())
			{

				swal({title: 'Error!',text: 'Password confirmation does not match password',type: 'error',confirmButtonText: 'OK'
					}) 
				return;
			}

		var parameters=[];
		var op='doSignup';
	 
		parameters.push($('#firstname').val());
		parameters.push($('#lastname').val());
		parameters.push($('#username').val());
		parameters.push($('#password').val());
		parameters.push($('#email').val()); 
		parameters.push($('#phone').val());
		parameters.push($('#address').val());
		
	if($('#accountid').val()>0){
			//parameters.push($('#productId').val());
			op='updateAccount';
		}

	$.post( "ajax.php", {op:op, parameters: parameters})
	  .done(function( data ) {
	  			
	  	  if(data.trim()=="1"){
				swal({
				  title: "Congratulations",
				  text: "Account has been created successfully.",
				  type: "success",
				  button: "OK!",
				});
				
			$ . ajax( {
					 			type: "POST",
					 			url: "ajax.php",
					 			data: {
									op:'login',
					 				username: $('#username').val(),
					 				password: $('#password').val()
					 			},
					 			success: function ( response ) {

					 					if ( $ . trim( response ) == "true" ) {
							
						
								setTimeout( function(){window.location = "dashboard"; }, 3 );	
										
								  
									}
									
		
								
							}
			
 	
					 }); 
					 //return false;
	
				
				  
		  }
		if(data.trim().includes("1062")){
				swal({
				  title: "Sorry",
				  text: "Account is already exist.",
				  type: "error",
				  button: "OK!",
				});
		
		}
			

	  
	  });


}

$(document).on('click', '.signup', function(){

	event.preventDefault();
	//$.sweetModal('Thanks for confirming!');

	doSignup();
})

$(document).on('click', '.btnRegister', function(){

event.preventDefault(); 
var matchid=this.id;
var cost=$(this).prev().html();


$.sweetModal.confirm('Confirm Registeration', 'Continue registration with cost <b> ('+cost+')?</b>', function() {
	doRegister(matchid);
}, function() {
	
});



});

</script>


</body>
</html>

<?php 
ob_end_flush(); 		
?>