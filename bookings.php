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
	$bookings=getBookingsByAccId($_SESSION['id']);

	foreach($bookings as $booking){
	 ?>
		<div class="shadow p-2 m-2 bg-white rounded col-sm-3 col-xs-12"   >
		<fieldset  >
			<div class="card-header text-center rounded">
				<span class="text-success text-capitalize font-weight-bold"><?php echo $booking['team1']; ?></span> VS 
				<span class="text-danger text-capitalize font-weight-bold"><?php echo $booking['team2']; ?></span>
			</div>
			<div class="card-body">
				<h5 class="card-title text-center col-12 text-primary "><?php echo $booking['stadium'] ?></h5>
				<h5 class="carsd-title text-center col-12 ">In :<?php echo $booking['location'] ?></h5>
				<h5 class="text-primary ">Date <span class="text-success"><?php echo $booking['matchdate']; ?></span></h5>
				<h5 class="text-warning ">Time <span class="text-dark"><?php echo $booking['matchtime']; ?></span></h5>
												
				<p class="card-text text-center "><span class="border rounded-circle font-weight-bold badge badge-info p-3 m-3 rcost" style=" font-size: 22px;"><?php echo $booking['registrationcost'].' $'; ?></span> </p>
			</div>
			</fieldset>
		</div>
	<?php }?>	
	</div>
</div>
 

<?php include("scripts.php"); ?>




</body>
</html>

<?php 
} // If Session End 


	else {
		header ('location:login');
		}
ob_end_flush(); 		
?>