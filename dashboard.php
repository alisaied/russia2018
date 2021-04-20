<?php 
error_reporting(0);
ob_start();
session_start();

if (isset($_SESSION['username']) && $_SESSION['username']!="") {
		   
$username = $_SESSION['username'];

include('dll.php');

include "head.php"; 

?>
<body>
<?php include "navbar.php"; ?>
<div class="container-fluid">
	<div class="row justify-content-center">
	<?php 
	$matches=getMatches();

	foreach($matches as $match){
	 ?>
		<div class="shadow p-2 m-2 bg-white rounded col-sm-3 col-xs-12" <?php if(!$match['isavailable']) echo 'style="opacity: 0.5; "'; ?>  >
		<fieldset <?php if(!$match['isavailable']) echo "disabled" ?> >
			<div class="card-header text-center rounded">
				<span class="text-success text-capitalize font-weight-bold"><?php echo $match['team1']; ?></span> VS 
				<span class="text-danger text-capitalize font-weight-bold"><?php echo $match['team2']; ?></span>
			</div>
			<div class="card-body">
				<h5 class="card-title text-center col-12 text-primary "><?php echo $match['stadium'] ?></h5>
				<h5 class="carsd-title text-center col-12 ">In :<?php echo $match['location'] ?></h5>
				<h5 class="text-primary ">Date <span class="text-success"><?php echo $match['matchdate']; ?></span></h5>
				<h5 class="text-warning ">Time <span class="text-dark"><?php echo $match['matchtime']; ?></span></h5>
												
				<p class="card-text text-center "><span class="border rounded-circle font-weight-bold badge badge-info p-3 m-3 rcost" style=" font-size: 22px;"><?php echo $match['registrationcost'].' $'; ?></span><button class="btn btn-primary btnRegister" id="<?php echo $match['id']; ?>">Register</button> </p>
			</div>
			</fieldset>
		</div>
	<?php }?>	
	</div>
</div>
 

<?php include("scripts.php"); ?>

<script>
function doRegister(matchid)
{
	$.ajax({
				  type: "POST",
				  url: "ajax.php",
				  data: {op:'doRegister',matchid:matchid},
				  cache: false,
				  success: function(data) {	  		
					if(data==1){
					toastr['success']('Registeration completed successfully');
					//$('#txtSearch').trigger('keyup');
					} 
					  else
					  toastr['error'](data.trim());
		

		 } // success
		}); // $.ajax
}
$(document).on('click', '.btnRegister', function(){

event.preventDefault(); 
var matchid=this.id;
var cost=$(this).prev().html();


$.sweetModal.confirm('Confirm Registeration', 'Continue registration with cost <b> ('+cost+')?</b>', function() {
	//$.sweetModal('Thanks for confirming!');
	
	doRegister(matchid);
}, function() {
	//$.sweetModal('!');
});



/*
swal({
  title: "Are you sure?",
  text: "You will not be able cancel booking after registration",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Yes, Register Now!",
  cancelButtonText: "No, Cancel!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm) {
  if (isConfirm) {
    //swal("Deleted!", "Your imaginary file has been deleted.", "success");
	alert("register()");
  } else {
    swal("Cancelled", "Your imaginary file is safe :)", "error");
  }
}); //swal

/*
if($('#ar').val()=="en" )
{
	var productImageTemp= uploadFile();
	//alert(productImageTemp);
	if(productImageTemp.length<10)
		productImageTemp=originalImg;
	 insertParameters=[];
	 myop='insertProduct';
	var isActive=$('#isActive').prop("checked") ? 1: 0;
	var showInSlide=$('#showInSlide').prop("checked") ? 1: 0;	 

		insertParameters.push(4);
		insertParameters.push($('#productName').val());
		insertParameters.push($('#description').val());
		insertParameters.push($('#details').val());
		insertParameters.push(productImageTemp); 
		insertParameters.push($('#slideTitle').val());
		insertParameters.push('iconName');
		insertParameters.push(showInSlide);
		insertParameters.push(1); 
		
	if($('#productId').val()>0){
			insertParameters.push($('#productId').val());
			myop='editProduct';
		}

}else
{
	myop='editProductAr';
	insertParameters=[];
	insertParameters.push($('#productName').val());
	insertParameters.push($('#description').val());
	insertParameters.push($('#details').val());
	insertParameters.push($('#slideTitle').val());
	insertParameters.push($('#productId').val());
}

	
		$.ajax({
				  type: "POST",
				  url: "ajax.php",
				  data: {op:myop,insertParameters:insertParameters},
				  cache: false,
				  success: function(data) {	  		
					if(data==1){
					toastr['success']('Changes saved successfully');
					$('#txtSearch').trigger('keyup');
					}
					  
					  else
					  toastr['error'](data);
		

		 } // success
		}); // $.ajax



productImageTemp=null;
originalImg=null;
$('#productModal').modal('hide');

*/
});

</script>


</body>
</html>

<?php 
} // If Session End 


	else {
		header ('location:login');
		}
ob_end_flush(); 		
?>