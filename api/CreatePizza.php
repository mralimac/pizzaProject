<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include "../php/PizzaHandler.php";
	
	$PizzaHandler = new PizzaHandler();

	$pizzaName = $_GET['name'];
	$userID = $_GET['id'];
	$base = $_GET['base'];
	$topping1 = $_GET['top1'];
	$topping2 = $_GET['top2'];
	$topping3 = $_GET['top3'];
	
	$resultOfPizza = $PizzaHandler->addPizza($topping1, $topping2, $topping3, $base, $userID, $pizzaName);
	
	if($resultOfPizza == null){
		echo json_encode(array("result" => false));
	}else{
		echo json_encode(array("result" => true));
	}
?>