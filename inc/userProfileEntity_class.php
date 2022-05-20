<?php
	class userProfileEntity extends Database{
		protected function getUserProfile($userProfile){
			$sql = "SELECT * FROM userprofile WHERE Name = '".$userProfile."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function getUserProfileWithId($id){
			$sql = "SELECT * FROM userprofile WHERE Id = '".$id."'";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function insertUserProfile($userProfile){
			$sql = "INSERT INTO userprofile (name) VALUES('".$userProfile."')";
		
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForChanges($userProfile, $id){
			$sql = "SELECT * FROM userprofile WHERE Name = '".$userProfile."' AND Id = '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function checkForDuplicates($userProfile, $id){
			$sql = "SELECT * FROM userprofile WHERE Name = '".$userProfile."' AND Id != '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function updateUserProfile($userProfile, $id){
			$sql = "UPDATE userprofile SET name = '".$userProfile."' WHERE Id = '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
		protected function removeUserProfile($id){
			$sql = "DELETE FROM userProfile WHERE Id = '".$id."'";
					
			$result = $this->connect()->query($sql);
			
			return $result;
		}
	}
?>