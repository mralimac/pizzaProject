<?php
	include "../php/UserHandler.php";
	
	$UserHandler = new UserHandler();

	$email = $_GET['id'];
	$password = $_GET['pass'];
	$address1 = $_GET['ad1'];
	$address2 = $_GET['ad2'];
	$address3 = $_GET['ad3'];
	$telephone = $_GET['tel'];
	//This creates a new user in the database
	$replyToUserCreation = $UserHandler->addNewPersonnel($password, $email, $address1, $address2, $address3, $telephone, 0);
	
	echo json_encode($replyToUserCreation);
?>