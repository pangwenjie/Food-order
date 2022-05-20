<?php
	class userBoundary extends userController{
		public function display(){
			echo '
			<form method="POST" action="" onsubmit="return validateForm(this)" id="addForm">
				<table id="addTable" class="table1" width="70%" align="center">
					<tr>
						<th colspan="2">Add New User</td>
					</tr>
					<tr>
						<td width="30%">Name:</td>
						<td width="100%">
							<input type="text" name="name" id="name" size="50" maxLength="50">
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
							 <input type="date" id="dateOfBirth" name="dateOfBirth">
							 <input size="20" type="hidden"  name="dateOfBirthError" id="dateOfBirthError">
							 <span id="dateOfBirthErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td>Phone Number:</td>
						<td>
							<input type="text" name="phoneNumber" id="phoneNumber" size="8" maxLength="8">
							<input size="20" type="hidden"  name="phoneNumberError" id="phoneNumberError">
							<span id="phoneNumberErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td>Email:</td>
						<td>
							<input type="text" name="email" id="email" size="50" maxLength="50">
							<input size="20" type="hidden"  name="emailError" id="emailError">
							<span id="emailErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td>User Type:</td>
						<td>
							<select name="userType" id="userType">';
							$result = $this->retrieveUserType();
							$counter = 0;
							while($row = mysqli_fetch_array($result)) {
								echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
								$counter ++;
							};
							echo '</select>
						</td>
					</tr>	
					<tr>
						<td colspan="2" align="center"> 
							<button type="submit" class ="btn-primary" id="addUserButton" style="margin-right: 70px;"> Create User Account </button>
							<button type="button" class ="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'user.php\'"> Back  </button>
						</td>
					</tr>
				</table>
			</form>
			';
		}
		
		function callCreateUserAccount(){
			$this->createUserAccount();
		}
		
		public function displayWithIdForModify($userId){
			$result = $this->retrieveUserWithId($userId);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = "'".$row['Name']."'";
					$password = $row['Password'];
					$dateOfBirth = $row['DateOfBirth'];						
					$phoneNumber = $row['PhoneNumber'];
					$email = $row['Email'];
					$userType = $row['UserType'];
					
					echo '
					<form method="POST" action="" onsubmit="return validateForm(this)" id="editForm">
						<table id="editTable" class="table1" width="70%" align="center">
							<tr>
								<th colspan="2">Edit User</td>
							</tr>
							<tr>
								<td width="30%">Name:</td>
								<td width="100%">
									<input type="text" name="name" id="name" size="50" maxLength="50" value='.$name.'>
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
									<input type="text" name="email" id="email" size="50" maxLength="50" value='.$email.'>
									<input size="20" type="hidden"  name="emailError" id="emailError">
									<span id="emailErrorMessage" class="errorMessage"></span>
								</td>
							</tr>
							<tr>
								<td>User Type:</td>
								<td>
									<select name="userType" id="userType">';
										$result = $this->retrieveUserType();
										$counter = 0;
										while($row = mysqli_fetch_array($result)) {
											echo '<option value="'.$row['name'].'"';if ($row['name'] == $userType) echo 'Selected'; echo'>'.$row['name'].'</option>';
											$counter ++;
										};
									echo '</select></select>
								</td>
							</tr>	
							<tr>
								<td colspan="2" align="center"> 
									<button type="submit" id="editUserButton" style="margin-right: 70px;"> Edit User Account</button>
									<button type="button" id="backButton" style="margin-left: 70px;" onClick="location.href=\'user.php\'"> Back  </button>
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
		
		function callModifyUserAccount($userId){
			$this->modifyUserAccount($userId);
		}
		
		public function displayWithIdForDelete($userId){
			$result = $this->retrieveUserWithId($userId);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = $row['Name'];
					$dateOfBirth = $row['DateOfBirth'];
					$phoneNumber = $row['PhoneNumber'];
					$email = $row['Email'];
					$userType = $row['UserType'];
					
					echo '
					<form method="POST" action="" onsubmit="return true" id="deleteForm">
						<table id="deleteTable" class="table1" width="70%" align="center">
							<tr>
								<th colspan="2">Delete User</td>
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
									<button type="submit" class = "btn-primary" id="deleteUserButton" style="margin-right: 70px;"> Delete User Account</button>
									<button type="button" class = "btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'user.php\'"> Back  </button>
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
		
		function callDeleteUserAccount($userId){
			$this->deleteUserAccount($userId);
		}
	}
?>