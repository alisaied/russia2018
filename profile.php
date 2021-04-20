<?php 
error_reporting(0);
ob_start();
session_start();

if (isset($_SESSION['username']) && $_SESSION['username']!="") {
	
include('dll.php');
include "head.php"; 
$user = getUserById($_SESSION['id']);

?>
<body>
<?php include "navbar.php"; ?>
<div class="container">
<br>
<div class="row  ">
<div class="col-sm-6 col-xs-12">
<form class="shadow p-3 m-3 bg-white rounded" id="profileFrm">
	  <div class="form-group row">
		<label for="firstname" class="col-sm-5 col-form-label">First Name</label> 
		<div class="col-sm-7">
		  <input id="firstname" name="firstname" placeholder="First Name" type="text" class="form-control " required="required" value="<?php echo $user['firstname']; ?>" >
		</div>
	  </div>
	  <div class="form-group row">
		<label for="lastname" class="col-sm-5 col-form-label">Last Name</label> 
		<div class="col-sm-7">
		  <input id="lastname" name="lastname" placeholder="Last Name" type="text" class="form-control " required="required" value="<?php echo $user['lastname']; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="username" class="col-sm-5 col-form-label">Username</label> 
		<div class="col-sm-7">
		  <input id="username" name="username" placeholder="Username" type="text" class="form-control " required="required" value="<?php echo $user['username']; ?>">
		</div>
	  </div>

	  <div class="form-group row">
		<label for="email" class="col-sm-5 col-form-label">Email</label> 
		<div class="col-sm-7">
		  <input id="email" name="email" placeholder="Email" type="text" class="form-control " required="required" value="<?php echo $user['email']; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="phone" class="col-sm-5 col-form-label">Telephone</label> 
		<div class="col-sm-7">
		  <input id="phone" name="phone" placeholder="Telephone" type="text" class="form-control " value="<?php echo $user['phone']; ?>">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="address" class="col-sm-5 col-form-label">Address</label> 
		<div class="col-sm-7">
		  <input id="address" name="address" placeholder="Address" type="text" class="form-control " value="<?php echo $user['address']; ?>">
		</div>
	  </div>

	  <div class="form-group row ">
		<div class="col-12 col-sm-5">
		  <button id="editProfile"  name="editProfile" class="btn btn-primary " >Edit Profile</button>
		</div>
	  </div>
	  <input type="hidden" id="accountid" value="<?php echo $user['id']; ?>" name="accountid">
	</form>
</div>

<div class="col-sm-6 col-xs-12">
<form class="shadow p-3 m-3 bg-white rounded " id="chargeFrm">
	 
	<div class="form-group row">
		<h4 class="alert alert-light" >Your Current Balance</h4><span class="alert text-success"><b>
		<?php echo $user['balance']; ?> $</b></span>
	  </div>	 
	  <div class="form-group row">
		<label for="pin1" class="col-sm-5 col-form-label">PIN 1</label> 
		<div class="col-sm-7">
		  <input id="pin1" name="pin1" placeholder="PIN 1" type="text" class="form-control " required="required" >
		</div>
	  </div>
	  
	  <div class="form-group row">
		<label for="pin2" class="col-sm-5 col-form-label">PIN 2</label> 
		<div class="col-sm-7">
		  <input id="pin2" name="pin2" placeholder="PIN 2" type="text" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="amount" class="col-sm-5 col-form-label">Amount</label> 
		<div class="col-sm-7">
		  <input id="amount" name="amount" placeholder="Amount" type="number" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row ">
		<div class="col-12 col-sm-5 ">
		  <button id="chargeBalance"  name="chargeBalance" class="btn btn-primary" >Charge Balance</button>
		</div>
	  </div>
	  
	</form>	
	</div>

<div class="col-sm-6 col-xs-12">	
<form class="shadow p-3 m-3 bg-white rounded " id="passwordFrm">
	 
	  <div class="form-group row">
		<label for="oldpassword" class="col-sm-5 col-form-label">Old Password</label> 
		<div class="col-sm-7">
		  <input id="oldpassword" name="oldpassword" placeholder="Old Password" type="password" class="form-control " required="required" >
		</div>
	  </div>
	  
	  <div class="form-group row">
		<label for="password" class="col-sm-5 col-form-label">Password</label> 
		<div class="col-sm-7">
		  <input id="password" name="password" placeholder="Password" type="password" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row">
		<label for="confirmPassword" class="col-sm-5 col-form-label">Confirmation</label> 
		<div class="col-sm-7">
		  <input id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" type="password" class="form-control " required="required">
		</div>
	  </div>
	  <div class="form-group row ">
		<div class="col-12 col-sm-5 ">
		  <button id="changePassword"  name="changePassword" class="btn btn-primary" >Change Password</button>
		</div>
	  </div>
	  
	</form>
</div>	

</div>




</div>
 

<?php include("scripts.php"); ?>

<script>
var op='edit';
$( document ).ready(function() {
	
	$('#profileFrm input').prop('readonly',true);
	$('#passwordFrm input').prop('readonly',true);
	
	//$('#editProfile').html('Edit Profile');
    	
});

$(document).on('click', '#editProfile', function(){

	event.preventDefault();
	if($('#editProfile').html()=="Edit Profile"){
		$('#editProfile').html("Update Profile");
		//$('form input').addAttr('readonly');
		$('#profileFrm input').prop('readonly',false);
		$('#username').prop('readonly',true);
	}else{ 
		// Save update	
		$('#editProfile').html("Edit Profile");
		//$('form input').removeAttr('readonly');
		
		$('#profileFrm input').prop('readonly',true);
		
		if($('#firstname').val() == "" || $('#lastname').val() == "" )
			{
				
				swal({title: 'Error!',text: 'Please input required fields',type: 'error',confirmButtonText: 'OK'
					}) 	
					$('#profileFrm input').prop('readonly',true);
				return;
			}
		updateProfile();	

		}


	//doSignup();
});

$(document).on('click', '#changePassword', function(){

	event.preventDefault();
	if($('#changePassword').html()=="Change Password"){
		$('#changePassword').html("Save Password");

		$('#passwordFrm input').prop('readonly',false);
		
	}else{
	
		// Save update	
		$('#changePassword').html("Change Password");
		//$('form input').removeAttr('readonly');
		
		$('#passwordFrm input').prop('readonly',true);
		
		if($('#password').val() == "" || $('#confirmPassword').val() == "" || $('#oldpassword').val() == "" )
			{
				
				swal({title: 'Error!',text: 'Please input required fields',type: 'error',confirmButtonText: 'OK'
					}) 	
					$('#profileFrm input').prop('readonly',true);
				return;
			}
		if ($('#password').val() != $('#confirmPassword').val())
			{

				swal({title: 'Error!',text: 'Password confirmation does not match password',type: 'error',confirmButtonText: 'OK'
					}) 
				return;
			}
			
			updatePassword();	


	//doSignup();
}
});

$(document).on('click', '#chargeBalance', function(){

	event.preventDefault();
	
	if($('#pin1').val() == "" || $('#pin2').val() == "" || $('#amount').val() == "" )
			{
				
				swal({title: 'Error!',text: 'Please input all required fields',type: 'error',confirmButtonText: 'OK'
					}) 	
					
				return;
			}
	
	updateBalance();	
	
});

function updateProfile(){


		var parameters=[];
		var op='updateProfile';

	op='updateAccount';
		
	$.post( "ajax.php", {op:op,firstname:$('#firstname').val(),
							    lastname:$('#lastname').val(),
								email:$('#email').val(),
								phone:$('#phone').val(),
								address:$('#address').val(),
								id:$('#accountid').val()
								})
	  .done(function( data ) {
	  			
	  	  if(data.trim()=="1"){
				swal({
				  title: "Done",
				  text: "Account has been updated successfully.",
				  type: "success",
				  button: "OK!",
				});
			}//end if
			else
			swal({
				  title: "Error",
				  text: "Error saving changes."+data,
				  type: "error",
				  button: "OK!",
				});
			
	 }); // end done


}

function updatePassword(){

		var op='updatePassword';
		

	op='updatePassword';
		
	$.post( "ajax.php", {op:op,oldpassword:$('#oldpassword').val(),
							    password:$('#password').val(),
								id:$('#accountid').val()
								})
	  .done(function( data ) {
	  			
	  	  if(data.trim()=="1"){
				swal({
				  title: "Done",
				  text: "Password has been changed successfully.",
				  type: "success",
				  button: "OK!",
				});
			}//end if
			else
			swal({
				  title: "Error",
				  text: "Error changing password."+data,
				  type: "error",
				  button: "OK!",
				});
			
	 }); // end done


}

function updateBalance(){

		var op='updateBalance';
		
		
	$.post( "ajax.php", {op:op,pin1:$('#pin1').val(),
							    pin2:$('#pin2').val(),
								amount:$('#amount').val()
								})
	  .done(function( data ) {
	  /*
	  swal({
				  title: "Done",
				  text: '44'+data,
				  type: "success",
				  button: "OK!",
				});*/
	  			
	  	  if(data.trim()=="1"){
				swal({
				  title: "Done",
				  text: "Your account has been charged successfully.",
				  type: "success",
				  button: "OK!",
				});
			}//end if
			else
			swal({
				  title: "Error",
				  text: "Error charging accountsssss."+ data,
				  type: "error",
				  button: "OK!",
				});
			
	 }); // end done


}



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