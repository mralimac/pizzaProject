<?php
	require_once "php/LoginHandler.php";
	//Checks if user is logged in
	$loginHandler = new LoginHandler();
	$isUserLoggedIn = $loginHandler->isLoggedIn();
	if($isUserLoggedIn != null){
		$currentUser = $loginHandler->getUser($isUserLoggedIn);
	}else{
		echo "<script>loadPage('login.php')</script>";
	}
?>