<?php
require_once 'Database.php';
require_once 'ToppingHandler.php';

class PizzaHandler extends Database{
	//Add a pizza to the database
	function addPizza($topping1, $topping2, $topping3, $base, $userID, $pizzaName){
		$toppings = $topping1."/".$topping2."/".$topping3;
		$pizzaID = md5(rand());
		$queryString = "INSERT INTO pizza VALUES('$pizzaID','$userID','$base','$toppings', '$pizzaName')";
		$queryResult = $this->query($queryString);
		if($queryResult){
			return array("result" => true);
		}else{
			return array("result" => false);
		}
	}
	
	//Gets a specific pizza based on its id
	function getPizza($pizzaID){
		$ToppingHandler = new ToppingHandler();
		$queryString = "SELECT * FROM pizza WHERE pizzaID = '$pizzaID'";
		$queryResult = $this->query($queryString);
		while($row = mysqli_fetch_assoc($queryResult)){
			$toppingID = $row['toppingID'];
			$toppings = explode("/",$toppingID);
			$toppingPrice1 = $ToppingHandler->getTopping($toppingID[0])["toppingPrice"];
			$toppingPrice2 = $ToppingHandler->getTopping($toppingID[2])["toppingPrice"];
			$toppingPrice3 = $ToppingHandler->getTopping($toppingID[4])["toppingPrice"];
			$toppingTotalPrice = $toppingPrice1 + $toppingPrice2 + $toppingPrice3;
			return array("pizzaID" => $row['pizzaID'], "pizzaName" => $row['pizzaName'], "pizzaPrice" => $toppingTotalPrice, "topping1" => $ToppingHandler->getTopping($toppingID[0])["toppingName"], "topping2" => $ToppingHandler->getTopping($toppingID[2])["toppingName"], "topping3" => $ToppingHandler->getTopping($toppingID[4])["toppingName"]);
		}
	}
	
	//Retrieve all pizzas including ones that relate to the users ID number
	function getAllPizzas($userID){
		$ToppingHandler = new ToppingHandler();
		$queryString = "SELECT * FROM pizza WHERE userID = 'admin' OR userID = '$userID'";
		$queryResult = $this->query($queryString);
		$i = 0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$toppingID = $row['toppingID'];
			$toppings = explode("/",$toppingID);
			$toppingPrice1 = $ToppingHandler->getTopping($toppingID[0])["toppingPrice"];
			$toppingPrice2 = $ToppingHandler->getTopping($toppingID[2])["toppingPrice"];
			$toppingPrice3 = $ToppingHandler->getTopping($toppingID[4])["toppingPrice"];
			$toppingTotalPrice = $toppingPrice1 + $toppingPrice2 + $toppingPrice3;
			$arrayOfGroup[$i] = array("pizzaID" => $row['pizzaID'], "pizzaName" => $row['pizzaName'], "pizzaPrice" => $toppingTotalPrice, "topping1" => $ToppingHandler->getTopping($toppingID[0])["toppingName"], "topping2" => $ToppingHandler->getTopping($toppingID[2])["toppingName"], "topping3" => $ToppingHandler->getTopping($toppingID[4])["toppingName"]);
			$i++;
		}
		return $arrayOfGroup;
	}
	
	//Gets all pizzas related to a users ID
	function getUserPizzas($userID){
		$ToppingHandler = new ToppingHandler();
		$queryString = "SELECT * FROM pizza WHERE userID = '$userID'";
		$queryResult = $this->query($queryString);
		$i = 0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$toppingID = $row['toppingID'];
			$toppings = explode("/",$toppingID);
			$toppingPrice1 = $ToppingHandler->getTopping($toppingID[0])["toppingPrice"];
			$toppingPrice2 = $ToppingHandler->getTopping($toppingID[2])["toppingPrice"];
			$toppingPrice3 = $ToppingHandler->getTopping($toppingID[4])["toppingPrice"];
			$toppingTotalPrice = $toppingPrice1 + $toppingPrice2 + $toppingPrice3;		
			
			$arrayOfGroup[$i] = array("pizzaID" => $row['pizzaID'], "pizzaName" => $row['pizzaName'], "pizzaPrice" => $toppingTotalPrice, "topping1" => $ToppingHandler->getTopping($toppingID[0])["toppingName"], "topping2" => $ToppingHandler->getTopping($toppingID[2])["toppingName"], "topping3" => $ToppingHandler->getTopping($toppingID[4])["toppingName"]);
			$i++;
		}
		return $arrayOfGroup;
	}
	
	//Deletes a pizza from the database
	function removePizza($pizzaID){
		$queryString = "DELETE FROM pizza WHERE pizzaID = '$pizzaID'";
		$queryResult = $this->query($queryString);
		if($queryResult){
			return array("result" => true);
		}else{
			return array("result" => false);
		}
	}
}

?>