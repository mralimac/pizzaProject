<?php
require_once 'Database.php';

class ToppingHandler extends Database{
	//Adds a topping. This is non-functional due to the lack of a need to add this
	function addTopping($toppingName, $toppingPrice, $toppingDesc, $stockID){
		
	}
	
	//Get all toppings from the database
	function getAllToppings(){
		$queryString = "SELECT toppingID, toppingName, toppingPrice, toppingDesc FROM topping";
		$queryResult = $this->query($queryString);
		$i = 0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$arrayOfGroup[$i] = array("toppingID" => $row['toppingID'], "toppingName" => $row['toppingName'], "toppingPrice" => $row['toppingPrice'], "toppingDesc" => $row['toppingDesc']);
			$i++;
		}
		return $arrayOfGroup;
	}
	
	//Fetch the specific price of a topping
	function getTopping($toppingID){
		$queryString = "SELECT * FROM topping WHERE toppingID = '$toppingID'";
		$queryResult = $this->query($queryString);
		$i = 0;
		while($row = mysqli_fetch_assoc($queryResult)){
			return array("toppingName" => $row['toppingName'], "toppingPrice" => $row['toppingPrice'], "toppingDesc" => $row['toppingDesc']);
			$i++;
		}
	}
}

?>