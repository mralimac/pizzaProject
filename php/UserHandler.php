<?php
require_once 'Database.php';

class UserHandler extends Database{
	
	function addNewPersonnel($password, $email, $address1, $address2, $address3, $telephone, $role){
		//Check if $password is null, error out if true
		if($password == null || $password == ""){
			return array("result" => false, "message" => "Password is empty", "code" => 100);
		}
		
		//Check if $password is null, error out if true
		if($email == null || $email == ""){
			return array("result" => false, "message" => "Email is empty", "code" => 101);
		}
		
		//This checks if the email already exists in the database
		$queryString = "SELECT email FROM user WHERE email = '$email'";
		$queryResult = $this->query($queryString);
		if(mysqli_num_rows($queryResult) > 0){
			return array("result" => false, "message" => "This email already exists", "code" => 201);
		}
		
		//Check if $password is null, error out if true
		if($address1 == null || $address1 == ""){
			return array("result" => false, "message" => "House address is empty", "code" => 102);
		}
		
		//Check if $password is null, error out if true
		if($address2 == null || $address2 == ""){
			return array("result" => false, "message" => "Street address is empty", "code" => 103);
		}
		
		//Check if $password is null, error out if true
		if($address3 == null || $address3 == ""){
			return array("result" => false, "message" => "City address is empty", "code" => 104);
		}
		
		//This checks if the telephone number already exists in the database
		$queryString = "SELECT userTelNo FROM user WHERE userTelNo = '$telephone'";
		$queryResult = $this->query($queryString);
		if(mysqli_num_rows($queryResult) > 0){
			return array("result" => false, "message" => "This telephone number already exists", "code" => 202);
		}
				
		//Create SessionID - This is the unique identifer for users via cookies
		$sessionID = md5(rand());
		
		//Create API key - This is the unique identifer for API interfaces
		$apiKey = md5(rand()); 
		
		//Joins the First and Last name together for storage 
		$address = $address1 ."|". $address2 ."|". $address3;
		
		//Checks if the passwords match
		
		//Hash the password so its suitable for database storage
		$hashPassword = password_hash($password, PASSWORD_DEFAULT);
		
		//Create a new person in the database
		$queryString = "INSERT INTO user VALUES ('$address', '$email', '$hashPassword','$telephone','$sessionID', 0)";
		$queryResult = $this->query($queryString);
		if($queryResult){
			//Return Positive Result
			return array("result" => true, "message" => "Person Successfully Added", "code" => 200);

		}else{
			//Return Failed Result
			return array("result" => false, "message" => "Adding Person Failed", "code" => 106);
		}
	}
	
	function removePersonnal($idNumber){
		$queryString = "DELETE FROM user WHERE userID = '$idNumber'";
		$queryResult = $this->query($queryString);
		if($queryResult){
			return true;
		}else{
			return false;
		}
	}
	
	function amendUser($selector, $selectorValue, $userID){
		$queryString = "UPDATE user SET $selector = '$selectorValue' WHERE userID = '$userID'";
		$queryResult = $this->query($queryString);
		if($queryResult){
			return array("result" => true);
		}else{
			return array("result" => false);
		}
	}
	
	function getSinglePerson($selector, $selectorValue){
		$queryString = "SELECT * FROM user WHERE $selector = '$selectorValue'";
		$queryResult = $this->query($queryString);
		$i=0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$arrayOfPeople[$i] = array("userAddress" => $row['userAddress'], "email" => $row['email'], "userTelNo" => $row['userTelNo']);
			$i++;
		}
		return $arrayOfPeople;
	}
	
	function getStaffByGroup($groupID){
		$queryString = "SELECT * FROM personnel WHERE groupID = '$groupID'";
		$queryResult = $this->query($queryString);
		$i=0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$arrayOfPeople[$i] = array("ID" => $row['ID'], "email" => $row['email'], "group" => $row['groupID'], "department" => $row['department'], "role" => $row['role'], "name" => $row['name'], "apiKey" => $row['apiKey']);
			$i++;
		}
		return $arrayOfPeople;
	}
	
	function getPeopleViaRole($role){
		if($role == '*'){
			$queryString = "SELECT * FROM personnel";
		}else{
			$queryString = "SELECT * FROM personnel WHERE role = $role";
		}
		$queryResult = $this->query($queryString);
		$arrayOfPeople = array();
		$i = 0;
		while($row = mysqli_fetch_assoc($queryResult)){
			$arrayOfPeople[$i] = array("ID" => $row['ID'], "email" => $row['email'], "group" => $row['groupID'], "department" => $row['department'], "role" => $row['role'], "name" => $row['name']);
			$i++;
		}
		return $arrayOfPeople;
		
		
	}
}
?>