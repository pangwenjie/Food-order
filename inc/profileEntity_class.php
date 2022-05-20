<?php
	class profileEntity extends Database{
		protected function getUserWithId($id){
			$sql = "SELECT * FROM userdirectory WHERE UserId = '".$id."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForChanges($name, $password, $dateOfBirth, $phoneNumber, $email, $id){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND Password = '".$password."' AND DateOfBirth = '".$dateOfBirth."' 
					AND PhoneNumber = '".$phoneNumber."' AND Email = '".$email."' AND UserId = '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForDuplicates($name, $dateOfBirth, $phoneNumber, $email, $id){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$name."' AND DateOfBirth = '".$dateOfBirth."' AND PhoneNumber = '".$phoneNumber."' 
					AND Email = '".$email."' AND UserId != '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function updateUser($name, $password, $dateOfBirth, $phoneNumber, $email, $id){
			$sql = "UPDATE userdirectory SET name = '".$name."', password = '".$password."', dateOfBirth = '".$dateOfBirth."',
					phoneNumber = '".$phoneNumber."', email = '".$email."',	updatedBy = '".$_SESSION['name']."' 
					WHERE UserId = '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
	}
?>