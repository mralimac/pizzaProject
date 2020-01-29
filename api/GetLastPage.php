<?php
	include "../php/LoginHandler.php";
	
	$LoginHandler = new LoginHandler();
	
	$cookieID = $_GET['id'];

	$lastPage = $LoginHandler->getLastPage($cookieID);
	
	if($lastPage != null){
		echo json_encode($lastPage);
	}else{
		echo json_encode(array("result" => false));
	}
?>