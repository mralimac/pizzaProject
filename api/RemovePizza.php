<?php
include "../php/PizzaHandler.php";
	
	$PizzaHandler = new PizzaHandler();
	
	$pizzaID = $_GET['id'];
	
	$resultOfPizza = $PizzaHandler->removePizza($pizzaID);
	
	if($resultOfPizza == null){
		echo json_encode(array("result" => false));
	}else{
		echo json_encode(array("result" => true));
	}
?>