<script>
	function validateForm(){
		var name = document.getElementById("name").value;

		if (name == '') {
			document.getElementById("nameErrorMessage").innerHTML = "Name must not be empty.";
			document.getElementById("nameError").value = false;
			return false;
		} else if (/^[a-zA-Z ]{1,50}$/.test(name) == false) {
			document.getElementById("nameErrorMessage").innerHTML = "Name must be words and no numbers.";
			document.getElementById("nameError").value = false;
			return false;
		} else {
			document.getElementById("nameErrorMessage").innerHTML = "";
			document.getElementById("nameError").value = true;
		}
		
		return true;
	}
</script>

<?php
	class userProfileController extends userProfileEntity{
		function addUserProfile(){
			if((isset($_POST['nameError']) !== '')){
				if((isset($_POST['nameError']) == true)){
						$name = $_POST['name'];
						
						$result1 = $this->getUserProfile($name);
						
						if($result1->num_rows == 0){
		
							$result = $this->insertUserProfile($name);
							
							if ($result === TRUE) {
								echo '<script>alert("New User Profile created successfully"); window.location.href="userProfile.php";</script>';
							} else {
								echo '<script>alert("Error: ' . $sql . '"<br>"' . $conn->error;'")</script>';
							}
						} else {
							echo '<script>alert("There is an exising user profile with the inputs that you have just entered.")</script>';
						} 
				}
			}
		}
		
		function retrieveUserProfileWithId($id){	
			$result = $this->getUserProfileWithId($id);	
				
			return $result;	
		}
		
		function modifyUserProfile($id){
			if((isset($_POST['nameError']) !== '')){
				if((isset($_POST['nameError']) == true)){
					$name = $_POST['name'];

					$result1 = $this->checkForChanges($name, $id);
					
					$result2 = $this->checkForDuplicates($name, $id);
					
					if(($result1->num_rows == 0) && ($result2->num_rows == 0)){

						$result = $this->updateUserProfile($name, $id);
						
						if ($result === TRUE) {
							echo '<script>alert("User Profile updated successfully"); window.location.href="userProfile.php";</script>';
						} else {
							echo '<script>alert("Error: "' . $sql . '"<br>"' . $conn->error;')</script>';
						}
					} else if ($result1->num_rows == 1) {
						echo '<script>alert("There was no changes made.")</script>';
					} else {
						echo '<script>alert("There is an exising user with the inputs that you have just entered.")</script>';
					}		
				}
			}
		}
		
		function deleteUserProfile($id){
			if((isset($_POST['nameError']) !== '')){
				if((isset($_POST['nameError']) == true)){
					$result = $this->removeUserProfile($id);
					
					if ($result === TRUE) {
						echo '<script>alert("User Profile deleted successfully"); window.location.href="userProfile.php";</script>';
					} else {
						echo '<script>alert("Error: "' . $sql . '"<br>"' . $conn->error;')</script>';
					}
				}
			}
		}
		
	}
?>