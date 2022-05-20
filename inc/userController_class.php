<script>
	function validateForm(){
		var name = document.getElementById("name").value;

		if (name == "") {
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
		
		var password = document.getElementById("password").value;
		
		if (password == "") {
			document.getElementById("passwordErrorMessage").innerHTML = "Password must not be empty";
			document.getElementById("passwordError").value = false;
			return false;
		} else if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/.test(password) == false) {
			document.getElementById("passwordErrorMessage").innerHTML = "Password must have at least 1 uppercase, 1 lowercase, 1 number and 1 symbol.";
			document.getElementById("passwordError").value = false;
			return false;
		} else {
			document.getElementById("passwordErrorMessage").innerHTML = "";
			document.getElementById("passwordError").value = true;
		}
		
		var dateOfBirth = document.getElementById("dateOfBirth").value;
		var today = new Date();
		var strDate = today.getFullYear() + "-" + ("0" + (today.getMonth() + 1)).slice(-2) + "-" + ("0" + today.getDate()).slice(-2);
		
		if (dateOfBirth == "") {
			document.getElementById("dateOfBirthErrorMessage").innerHTML = "Date must not be empty.";
			document.getElementById("dateOfBirthError").value = false;
			return false;
		} else if (dateOfBirth >= strDate) {
			document.getElementById("dateOfBirthErrorMessage").innerHTML = "Date selected must be before today.";
			document.getElementById("dateOfBirthError").value = false;
			return false;
		} else {
			document.getElementById("dateOfBirthErrorMessage").innerHTML = "";
			document.getElementById("dateOfBirthError").value = true;
		}

		var phoneNumber = document.getElementById("phoneNumber").value;

		if (phoneNumber == "") {
			document.getElementById("phoneNumberErrorMessage").innerHTML = "Phone Number must not be empty.";
			document.getElementById("phoneNumberError").value = false;
			return false;
		} else if (/^[0-9]{8}$/.test(phoneNumber) == false) {
			document.getElementById("phoneNumberErrorMessage").innerHTML = "Phone Number must be in numbers and have 8 digits.";
			document.getElementById("phoneNumberError").value = false;
			return false;
		} else {
			document.getElementById("phoneNumberErrorMessage").innerHTML = "";
			document.getElementById("phoneNumberError").value = true;
		}
		
		var email = document.getElementById("email").value;
		
		if (email == "") {
			document.getElementById("emailErrorMessage").innerHTML = "Email must not be empty.";
			document.getElementById("emailError").value = false;
			return false;
		} else if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email) == false) {
			document.getElementById("emailErrorMessage").innerHTML = "Email is in the wrong format.";
			document.getElementById("emailError").value = false;
			return false;
		} else {
			document.getElementById("emailErrorMessage").innerHTML = "";
			document.getElementById("emailError").value = true;
		}
		
		return true;
	}			
</script>

<?php
	class userController extends userEntity{
		function retrieveUserType(){
			$result = $this->getUserType();		
			
			return $result;
		}

		function createUserAccount(){
			if((isset($_POST['nameError']) !== '') 
				&& (isset($_POST['passwordError']) !== '')
				&& (isset($_POST['dateOfBirthError']) !== '')
				&& (isset($_POST['phoneNumberError']) !== '')
				&& (isset($_POST['emailError']) !== '')){
					if((isset($_POST['nameError']) == true) 
						&& (isset($_POST['passwordError']) == true)
						&& (isset($_POST['dateOfBirthError']) == true)
						&& (isset($_POST['phoneNumberError']) == true)
						&& (isset($_POST['emailError']) == true)){
							$name = $_POST['name'];
							$password = $_POST['password'];
							$dateOfBirth = $_POST['dateOfBirth'];
							$phoneNumber = $_POST['phoneNumber'];
							$email = $_POST['email'];
							$userType = $_POST['userType'];

							$result1 = $this->getUser($name, $dateOfBirth, $phoneNumber, $email);
							
							if($result1->num_rows == 0){

								$result = $this->insertUser($name, $password, $dateOfBirth, $phoneNumber, $email, $userType);
								
								if ($result === TRUE) {
									echo '<script>alert("New User created successfully"); window.location.href="user.php";</script>';
								} else {
									echo '<script>alert("Error: ' . $sql . '"<br>"' . $conn->error;'")</script>';
								}
							} else {
								echo '<script>alert("There is an exising user with the inputs that you have just entered.")</script>';
							}
						}
				}
		}

		function retrieveUserWithId($userId){	
			$result  = $this->getUserWithId($userId);	
				
			return $result;	
		}
		
		function modifyUserAccount($userId){
			if((isset($_POST['nameError']) !== '') 
				&& (isset($_POST['passwordError']) !== '')
				&& (isset($_POST['dateOfBirthError']) !== '')
				&& (isset($_POST['phoneNumberError']) !== '')
				&& (isset($_POST['emailError']) !== '')){
					if((isset($_POST['nameError']) == true) 
						&& (isset($_POST['passwordError']) == true)
						&& (isset($_POST['dateOfBirthError']) == true)
						&& (isset($_POST['phoneNumberError']) == true)
						&& (isset($_POST['emailError']) == true)){
							$name = $_POST['name'];
							$password = $_POST['password'];
							$dateOfBirth = $_POST['dateOfBirth'];
							$phoneNumber = $_POST['phoneNumber'];
							$email = $_POST['email'];
							$userType = $_POST['userType'];
							
							$result1 = $this->checkForChanges($name, $password, $dateOfBirth, $phoneNumber, $email, $userType, $userId);

							$result2 = $this->checkForDuplicates($name, $dateOfBirth, $phoneNumber, $email, $userId);
							
							if(($result1->num_rows == 0) && ($result2->num_rows == 0)){

								$result = $this->updateUser($name, $password, $dateOfBirth, $phoneNumber, $email, $userType, $userId);
								
								if ($result === TRUE) {
									echo '<script>alert("User updated successfully"); window.location.href="user.php";</script>';
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
		
		function deleteUserAccount($userId){
			if((isset($_POST['nameError']) !== '') 
				&& (isset($_POST['dateOfBirthError']) !== '')
				&& (isset($_POST['phoneNumberError']) !== '')
				&& (isset($_POST['emailError']) !== '')){
					if((isset($_POST['nameError']) == true) 
						&& (isset($_POST['dateOfBirthError']) == true)
						&& (isset($_POST['phoneNumberError']) == true)
						&& (isset($_POST['emailError']) == true)){
							$sql = "DELETE FROM userdirectory WHERE UserId = '".$userId."'";
							
							$result = $this->removeUser($userId);
							
							if ($result === TRUE) {
								echo '<script>alert("User deleted successfully"); window.location.href="user.php";</script>';
							} else {
								echo '<script>alert("Error: "' . $sql . '"<br>"' . $conn->error;')</script>';
							}
						}
				}
		}
	}
?>