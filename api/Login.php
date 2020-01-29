<?php
	include "../php/LoginHandler.php";
	
	$LoginHandler = new LoginHandler();


	$username = $_GET['id'];
	$password = $_GET['pass'];

	$isUserLoggedIn = $LoginHandler->isLoggedIn();
	
	
	if($isUserLoggedIn == null){
		$login = $LoginHandler->login($username, $password);
		if($login){
			echo "1";
		}else{
			echo "0";
		}
	}else{
		echo "2";
	}
?>