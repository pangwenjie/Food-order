<?php
	class loginEntity extends Database{
		// Retrieve menu items from database to pass back to controller class for processing.
		protected function getAccDetails($username, $password){
			$sql = "SELECT * FROM userdirectory WHERE Name = '".$username."' AND Password = '".$password."' limit 1";
			
			$result = $this->connect()->query($sql);
			
			return $result;
		}
		
	}
?>