<?php 
$thPrefix='th_';

include('connectionPDO.php');

function getUser($username,$password){
	global $connection;
	$user=null;
	$query="SELECT `id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `address`, `balance` FROM `accounts` WHERE `username`=?  AND  `password`=SHA1(?)";

	try
	{
		$stmt = $connection->prepare($query);
		$stmt->execute([$username,$password]);
		$user=$stmt->fetch();
		//$count = $stmt->rowCount();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $user;
}

function getUserById($id){
	global $connection;
	$user=null;
	$query="SELECT `id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `address`, `balance` FROM `accounts` WHERE `id`=?";

	try
	{
		$stmt = $connection->prepare($query);
		$stmt->execute([$id]);
		$user=$stmt->fetch();
		//$count = $stmt->rowCount();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $user;
}

function getMatches(){
	global $connection; 
	$result=array();	

	$query="SELECT  m.id, m.team1id, m.team2id, t1.team as team1, t2.team as team2, m.matchdate, m.matchtime, m.stadiumid, m.isavailable, m.registrationcost, s.stadium, s.location
	FROM matches m
	INNER JOIN teams t1 on t1.id = m.team1id
	INNER JOIN teams t2 on t2.id = m.team2id
	INNER JOIN stadiums s on s.id = m.stadiumid
	WHERE m.matchdate > NOW()
	";
	try
	{	
		$stmt = $connection->prepare($query);
		$stmt->execute();
		$result=$stmt->fetchAll();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result;
}

function getBookingsByAccId($accountId){
	global $connection; 
	$result=array();	

	$query="SELECT  m.id, m.team1id, m.team2id, t1.team as team1, t2.team as team2, m.matchdate, m.matchtime, m.stadiumid, m.isavailable, m.registrationcost, s.stadium, s.location
	FROM matches m
	INNER JOIN teams t1 on t1.id = m.team1id
	INNER JOIN teams t2 on t2.id = m.team2id
	INNER JOIN stadiums s on s.id = m.stadiumid
    INNER JOIN bookings b on b.matchid = m.id
	WHERE b.accountid =?
	";
	try
	{	
		$stmt = $connection->prepare($query);
		$stmt->execute([$accountId]);
		$result=$stmt->fetchAll();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result;
} // End getBookingsByAccId

function getBalance($accountid){
	global $connection;
	$query="SELECT  `balance` FROM `accounts` WHERE `id`=? ";

	try
	{
		$stmt = $connection->prepare($query);
		$stmt->execute([$accountid]);
		$result=$stmt->fetch();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result['balance'];
} // End getBalance

function getMatchCost($matchid){

	global $connection;
	$query="SELECT `registrationcost` FROM `matches` WHERE id  = ? ";

	try
	{
		$stmt = $connection->prepare($query);
		$stmt->execute([$matchid]);
		$result=$stmt->fetch();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result['registrationcost'];


} // End getMatchCost

function insertBooking($insertParameters){
	global $connection;
	$result=false;
	$query="INSERT INTO `bookings` (`id`, `accountid`, `matchid`) VALUES (NULL, ?, ?)";
	try
	{
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute($insertParameters);
	}catch(PDOException $ex)
	{
		return $ex->getMessage();
		//throw $ex;
	}
	 return $result;

} // End insertBooking

function insertAccount($insertParameters){
	global $connection;
	$result = false;
	$query = "INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `phone`, `address`, `balance`) VALUES (NULL, ?, ?, ?, SHA1(?), ?, ?, ?, 0.00)";

	try
	{
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute($insertParameters);
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result;
} // End insertAccount

function updateBalance($accountId,$amount){
	global $connection;
	$result=false;
	$query="UPDATE `accounts` SET balance=balance+? WHERE id=?";
	try
	{
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute([$amount,$accountId]);
	}catch(PDOException $ex)
	{
		return $ex->getMessage();
		//throw $ex;
	}
	 return $result;
} // End updateBalance

function updateAccount($parameters){
	global $connection;
	$result=false;
	$query="UPDATE `accounts` SET `firstname`=?,`lastname`=?,`email`=?,`phone`=?,`address`=? WHERE `id`=?";
	try
	{
		
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute($parameters);
		
	}catch(PDOException $ex)
	{
		return $ex->getCode();
		//throw $ex;
	}
	 return $result;
} // End updateAccount

function updatePassword($parameters){
	global $connection;
	$result=false;
	$query="UPDATE `accounts` SET `password`=SHA1(?) WHERE `id`=?";
	try
	{
		
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute($parameters);
		
	}catch(PDOException $ex)
	{
		return $ex->getCode();
		//throw $ex;
	}
	 return $result;
} // End updateAccount

function generatePINs($amount){
	global $connection;
	$result=false;
	$query="INSERT INTO `prepaidcards` (`id`, `pin1`, `pin2`, `amount`, `accountid`, `transactiondate`) VALUES (NULL, md5(rand()), md5(rand()), ? , NULL, NULL)";
	try
	{
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute([$amount]);
	}catch(PDOException $ex)
	{
		return $ex->getMessage();
		//throw $ex;
	}
	 return $result;

} // End insertBooking

function getCard($amount,$pin1,$pin2){
	global $connection;
	$result=null;
	$query="SELECT `id`, `pin1`, `pin2`, `amount`, `accountid`, `transactiondate` FROM `prepaidcards` WHERE `amount` = ? AND `pin1` = ? AND `pin2` = ? AND accountid IS NULL";

	try
	{
		$stmt = $connection->prepare($query);
		$stmt->execute([$amount,$pin1,$pin2]);
		$result=$stmt->fetch();
		//$count = $stmt->rowCount();
		
	}catch(PDOException $ex)
	{
		echo $ex->getMessage();
		//throw $ex;
	}
	 return $result['id'];
}

function updateCards($cardid,$accountid){
	global $connection;
	$result=false;
	$query="UPDATE `prepaidcards` SET `accountid`=? , `transactiondate`=UTC_TIMESTAMP() WHERE `prepaidcards`.`id` = ?;";
	try
	{
		$stmt  = $connection->prepare($query);
		$result= $stmt->execute([$accountid,$cardid]);
	}catch(PDOException $ex)
	{
		return $ex->getMessage();
		//throw $ex;
	}
	 return $result;
} // End updateBalance
?>