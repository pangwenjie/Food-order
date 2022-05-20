<?php
	class profileBoundary extends profileController{
		public function displayWithIdForView($id){
			$result = $this->retrieveProfile($id);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = $row['Name'];
					$dateOfBirth = $row['DateOfBirth'];
					$phoneNumber = $row['PhoneNumber'];
					$email = $row['Email'];
					$userType = $row['UserType'];
					
					echo '
					<form method="POST" action="" onsubmit="return true" id="viewForm">
						<table id="viewTable" class="table1" width="90%" align="center">
							<tr>
								<th colspan="2">View Profile</td>
							</tr>
							<tr>
								<td width="30%">Name:</td>
								<td width="100%">
									'.$name.'
									<input size="20" type="hidden"  name="nameError" id="nameError">
									<span id="nameErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Date Of Birth:</td>
								<td>
									 '.$dateOfBirth.'
									 <input size="20" type="hidden"  name="dateOfBirthError" id="dateOfBirthError">
									 <span id="dateOfBirthErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Phone Number:</td>
								<td>
									 '.$phoneNumber.'
									 <input size="20" type="hidden"  name="phoneNumberError" id="phoneNumberError">
									 <span id="phoneNumberErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>
									 '.$email.'
									 <input size="20" type="hidden"  name="emailError" id="emailhError">
									 <span id="emailErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>User Type:</td>
								<td>
									 '.$userType.'
									 <input size="20" type="hidden"  name="userTypeError" id="userTypeError">
									 <span id="userTypeErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"> 
									<button type="button" class = "btn-primary" id="updateProfileButton" style="margin-right: 70px;" onClick="location.href=\'updateProfile.php?userId='.$id.'\'"> Update Profile </button>
									<button type="button" class ="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=';
									if ($_SESSION['userType'] == 'system admin'){
										echo '\'SystemAdmin.php\'';
									} else if ($_SESSION['userType'] == 'restaurant staff'){
										echo '\'staffInterface.php\'';
									} else if ($_SESSION['userType'] == 'restaurant manager'){
										echo '\'restaurantManager.php\'';
									} else if ($_SESSION['userType'] == 'customer'){
										echo '\'menu.php\'';
									} else {
										echo '\'restaurantOwner.php\'';
									};
									echo'"> Back  </button>
								</td>
							</tr>
						</table>
					</form>
					';
				}
			} else {
				echo '<script> alert("The User you have selected cannot be found."); window.location.href="user.php"; </script>';
			}
		}
		
		public function displayWithIdForUpdate($id){
			$result = $this->retrieveProfile($id);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = "'".$row['Name']."'";
					$password = $row['Password'];
					$dateOfBirth = $row['DateOfBirth'];						
					$phoneNumber = $row['PhoneNumber'];
					$email = $row['Email'];
					
					echo '
					<form method="POST" action="" onsubmit="return validateForm(this)" id="updateForm">
						<table id="updateTable" class="table1" width="90%" align="center">
							<tr>
								<th colspan="2">Update Profile</td>
							</tr>
							<tr>
								<td width="30%">Name:</td>
								<td width="100%">
									<input type="text" name="name" id="name" size="20" maxLength="50" value='.$name.'>
									<input size="20" type="hidden"  name="nameError" id="nameError">
									<span id="nameErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Password:</td>
								<td>
									<input type="text" name="password" id="password" size="12" maxLength="12">
									<input size="20" type="hidden"  name="passwordError" id="passwordError">
									<span id="passwordErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Date Of Birth:</td>
								<td>
									 <input type="date" id="dateOfBirth" name="dateOfBirth" value='.$dateOfBirth.'>
									 <input size="20" type="hidden"  name="dateOfBirthError" id="dateOfBirthError">
									 <span id="dateOfBirthErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Phone Number:</td>
								<td>
									<input type="text" name="phoneNumber" id="phoneNumber" size="8" maxLength="8" value='.$phoneNumber.'>
									<input size="20" type="hidden"  name="phoneNumberError" id="phoneNumberError">
									<span id="phoneNumberErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>Email:</td>
								<td>
									<input type="text" name="email" id="email" size="20" maxLength="50" value='.$email.'>
									<input size="20" type="hidden"  name="emailError" id="emailError">
									<span id="emailErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="center"> 
									<button type="submit" class = "btn-primary" id="editUserButton" style="margin-right: 70px;"> Update Profile </button>
									<button type="button" class = "btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'viewProfile.php\'"> Back  </button>
								</td>
							</tr>
						</table>
					</form>
					';
				}
			} else {
				echo '<script> alert("The User you have selected cannot be found."); window.location.href="user.php"; </script>';
			}
		}
		
		function callModifyProfile($id){
			$this->modifyProfile($id);
		}
	}
?>