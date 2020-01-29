<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include "../php/UserHandler.php";
	
	$UserHandler = new UserHandler();

	$userID = $_GET['id'];
	
	$user = $PizzaHandler->getUser("userID", $userID);
	
	if($pizza != null){
		echo json_encode($user);
	}
?>