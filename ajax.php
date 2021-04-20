<?php
session_start();	
include "connectionPDO.php";
include('dll.php');

// Log in authentication
 
if (isset($_POST['op']) && ($_POST['op']=='login')) {
	
	if (isset($_POST['username']) && isset($_POST['password'])) {
  
 		$result = 0;
 		$username = $_POST['username'];
		$password = $_POST['password']; 

		$user=getUser($username,$password);

	if($user['id']<1)
	{
		echo 'false';
	}
	else
	{
			$_SESSION['id']  	   = $user['id'];	
			$_SESSION['username']  = $user['username'];	
			$_SESSION['firstname'] = $user['firstname'];	
			$_SESSION['lastname']  = $user['lastname'];	

			echo 'true';
	}
	
} 

}
 
if (isset($_POST['op']) && ($_POST['op']=='doRegister')) {

  $insertParameters=array($_SESSION['id'],$_POST['matchid']);
  $matchCost = doubleval( getMatchCost($_POST['matchid']));
  
  if(getBalance($_SESSION['id'])>= $matchCost){
   
   	if(insertBooking($insertParameters) && updateBalance($_SESSION['id'],-$matchCost))
	  echo("1");
	else
	 	echo ("Error");
		
  }else
  	echo("You do not have enough money.");
 
 }  // 
 
if (isset($_POST['op']) && ($_POST['op']=='doSignup')) {
 	
   	$result = insertAccount($_POST['parameters']);
	
 	echo $result;
 }  // 
 
if (isset($_POST['op']) && ($_POST['op']=='updateAccount')) {
 	$parameters=array($_POST['firstname'],$_POST['lastname'],$_POST['email'],$_POST['phone'],$_POST['address'],$_POST['id']);
	
   	$result = updateAccount($parameters);
	
 	echo $result;
 }  // 
 
if (isset($_POST['op']) && ($_POST['op']=='updatePassword')) {
 	$parameters=array($_POST['password'],$_POST['id']);
	
   	$result = updatePassword($parameters);
	
 	echo $result;
 }  // 

if (isset($_POST['op']) && ($_POST['op']=='updateBalance')) {
	
	$result = false;
	//echo getCard(100, '43278a31c3261f3d008d60741c1feca6', 'b394eb7f311a5def77f7c1746950614d');
	//echo "1";
	$cardid= getCard($_POST['amount'], $_POST['pin1'], $_POST['pin2']);
	
	if($cardid > 0)
	{
		$result=updateBalance($_SESSION['id'],$_POST['amount']) && updateCards($cardid,$_SESSION['id']);
		
	}
 	if($result)
		echo "1";
	else
	echo "error";

 }  //

?>