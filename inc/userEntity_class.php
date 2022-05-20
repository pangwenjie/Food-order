<?php
	class userEntity extends Database{
		protected function getUserType(){
			$sql = "SELECT name FROM userprofile";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function getUser($name, $dateOfBirth, $phoneNumber, $email){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND DateOfBirth = '".$dateOfBirth."' 
					AND PhoneNumber = '".$phoneNumber."' AND Email = '".$email."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function insertUser($name, $password, $dateOfBirth, $phoneNumber, $email, $userType){
			$sql = "INSERT INTO userdirectory (name, password, dateOfBirth, phoneNumber, email, userType, createdBy, updatedBy) 
					VALUES('".$name."', '".$password."', '".$dateOfBirth."', '".$phoneNumber."', '".$email."', '".$userType."', '".$_SESSION['name']."', '".$_SESSION['name']."')";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function getUserWithId($userId){
			$sql = "SELECT * FROM userdirectory WHERE UserId = '".$userId."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForChanges($name, $password, $dateOfBirth, $phoneNumber, $email, $userType, $userId){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND Password = '".$password."' AND DateOfBirth = '".$dateOfBirth."' 
					AND PhoneNumber = '".$phoneNumber."' AND Email = '".$email."' AND UserType = '".$userType."' AND UserId = '".$userId."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForDuplicates($name, $dateOfBirth, $phoneNumber, $email, $userId){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND DateOfBirth = '".$dateOfBirth."' AND PhoneNumber = '".$phoneNumber."' 
					AND Email = '".$email."' AND UserId != '".$userId."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function updateUser($name, $password, $dateOfBirth, $phoneNumber, $email, $userType, $userId){
			$sql = "UPDATE userdirectory SET name = '".$name."', password = '".$password."', dateOfBirth = '".$dateOfBirth."',
					phoneNumber = '".$phoneNumber."', email = '".$email."',	userType = '".$userType."',	updatedBy = '".$_SESSION['name']."' 
					WHERE UserId = '".$userId."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function removeUser($userId){
			$sql = "DELETE FROM userdirectory WHERE UserId = '".$userId."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
	}
?>