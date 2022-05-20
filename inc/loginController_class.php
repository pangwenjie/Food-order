<script>
	function validateAcc(){
		var name = document.getElementById("name").value;
		var password = document.getElementById("password").value;
				
		if (name == "") {
			document.getElementById("nameErrorMessage").innerHTML = "Name must be filled up.";
			document.getElementById("nameError").value = false;
			return false;
		} else if (/^[a-zA-Z]{1,10}$/.test(name) == false) {
			document.getElementById("nameErrorMessage").innerHTML = "Name must be a single word with no space and no numbers.";
			document.getElementById("nameError").value = false;
			return false;
		} else {
			document.getElementById("nameErrorMessage").innerHTML = "";
			document.getElementById("nameError").value = true;
		}
		
		if (password == "") {
			document.getElementById("passwordErrorMessage").innerHTML = "Password must be filled up.";
			document.getElementById("passwordError").value = false;
			return false;
		} else if (/^.{8,12}$/.test(password) == false) {
			document.getElementById("passwordErrorMessage").innerHTML = "Password must be between 8 - 12 characters";
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
		
		return true;
	}
</script>

<?php
	class loginController extends loginEntity{
		function loginAcc(){
			if((isset($_POST['nameError']) !== '') && (isset($_POST['passwordError']) !== '')){
				if((isset($_POST['nameError']) == true) && (isset($_POST['passwordError']) == true)){
					$username = $_POST['name'];
					$password = $_POST['password'];
					
					$result = $this->getAccDetails($username, $password);
					
					if($result->num_rows == 1){
						echo "You have logged in";
									
						while($row = mysqli_fetch_array($result)){
							$_SESSION['name'] = $username;
							$_SESSION['userId'] = $row['UserId'];
							if($row["UserType"] == "System Admin"){
								header('location: systemAdmin.php');
								$_SESSION['userType'] = "system admin";
							} else if($row["UserType"] == "Restaurant Staff"){
								header('location: staffInterface.php');
								$_SESSION['userType'] = "restaurant staff";
							} else if($row["UserType"] == "Restaurant Manager"){
								header('location: restaurantManager/insights.php');
								$_SESSION['userType'] = "restaurant manager";
							} else if($row["UserType"] == "Customer"){
								header('location: menu.php');
								$_SESSION['userType'] = "customer";
							} else {
								header('location: restaurantOwner.php');
								$_SESSION['userType'] = "restaurant owner";
							}
						}
					} else {
						echo '<script>alert("You have failed to login")</script>'; 
					}
				}
			}
		}
	}
ob_flush();
?>
