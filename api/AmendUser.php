<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include "../php/UserHandler.php";
	include "../php/LoginHandler.php";
	
	$UserHandler = new UserHandler();
	$LoginHandler = new LoginHandler();
	
	
	$userID = $_GET['id'];
	$selector = $_GET['type'];
	$selectorValue = $_GET['value'];
	
	$userObject = $LoginHandler->getUser($userID);
	$userAddress = $userObject["userAddress"];
	$explodingUserAddress = explode("|", $userAddress);
	
	if($selector == "ad1"){
		$explodingUserAddress[0] = $selectorValue;
		$selector = "userAddress";
		$selectorValue = implode("|", $explodingUserAddress);
	}
	
	if($selector == "ad2"){
		$explodingUserAddress[1] = $selectorValue;
		$selector = "userAddress";
		$selectorValue = implode("|", $explodingUserAddress);
	}
	
	if($selector == "ad3"){
		$explodingUserAddress[2] = $selectorValue;
		$selector = "userAddress";
		$selectorValue = implode("|", $explodingUserAddress);
	}
	$amendUserReply = $UserHandler->amendUser($selector, $selectorValue, $userID);
	
	if($amendUserReply != null){
		echo json_encode(array("results" => true));
	}else{
		echo json_encode(array("results" => false));
	}
?>