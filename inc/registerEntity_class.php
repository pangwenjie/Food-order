<?php
	class registerEntity extends Database{
		protected function getCustomerDetails($name, $dateOfBirth, $phoneNumber, $email){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND DateOfBirth = '".$dateOfBirth."' 
					AND PhoneNumber = '".$phoneNumber."' AND Email = '".$email."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function insertAccount($name, $password, $dateOfBirth, $phoneNumber, $email, $userType){
			$sql = "INSERT INTO userdirectory (name, password, dateOfBirth, phoneNumber, email, userType, createdBy, updatedBy) 
					VALUES('".$name."', '".$password."', '".$dateOfBirth."', '".$phoneNumber."', '".$email."', '".$userType."', '".$_SESSION['name']."', '".$_SESSION['name']."')";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
	}
?>