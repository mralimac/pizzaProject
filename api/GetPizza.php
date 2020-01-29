<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include "../php/PizzaHandler.php";
	
	$PizzaHandler = new PizzaHandler();

	$pizzaID = $_GET['id'];
	
	$pizza = $PizzaHandler->getPizza($pizzaID);
	
	if($pizza != null){
		echo json_encode($pizza);
	}
?>