<?php
	class userProfileBoundary extends userProfileController{
		public function display(){
			echo '
			<form method="POST" action="" onsubmit="return validateForm(this)" id="addForm">
				<table id="addTable" class="table1" width="70%" align="center">
					<tr>
						<th colspan="2">Add User Profile</td>
					</tr>
					<tr>
						<td width="30%">Name:</td>
						<td width="100%">
							<input type="text" name="name" id="name" size="100" maxLength="100">
							<input size="20" type="hidden"  name="nameError" id="nameError">
							<span id="nameErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"> 
							<button type="submit" id="addUserProfileButton" style="margin-right: 70px;" onClick="validateForm()"> Create User Profile </button>
							<button type="button" id="backButton" style="margin-left: 70px;" onClick="location.href=\'userProfile.php\'"> Back  </button>
						</td>
					</tr>
				</table>
			</form>
			';
		}
		
		function callAddUserProfile(){
			$this->addUserProfile();
		}
		
		public function displayWithIdForModify($id){
			$result = $this->retrieveUserProfileWithId($id);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = $row['Name'];
					
					echo '
					<form method="POST" action="" onsubmit="return validateForm(this)" id="editForm">
						<table id="editTable" class="table1" width="70%" align="center">
							<tr>
								<th colspan="2">Modify User Profile</td>
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
								<td colspan="2" align="center"> 
									<button type="submit" class ="btn-primary" id="modifyUserProfileButton" style="margin-right: 70px;"> Modify User Profile </button>
									<button type="button" class = "btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'userProfile.php\'"> Back  </button>
								</td>
							</tr>
						</table>
					</form>
					';
				}
			} else {
				echo '<script> alert("The User Profile you have selected cannot be found."); window.location.href="userProfile.php"; </script>';
			}
		}
		
		function callModifyUserProfile($id){
			$this->modifyUserProfile($id);
		}
		
		public function displayWithIdForDelete($id){
			$result = $this->retrieveUserProfileWithId($id);
			
			if($result->num_rows == 1) {
				while($row = mysqli_fetch_array($result)) {
					$name = $row['Name'];
					
					echo '
					<form method="POST" action="" onsubmit="return true" id="deleteForm">
						<table id="deleteTable" class="table1" width="70%" align="center">
							<tr>
								<th colspan="2">Confirm Delete User ?</td>
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
								<td colspan="2" align="center"> 
									<button type="submit" class ="btn-primary" id="deleteUserProfileButton" style="margin-right: 70px;"> Delete User Profile </button>
									<button type="button" class ="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'userProfile.php\'"> Back  </button>
								</td>
							</tr>
						</table>
					</form>
					';
				}
			} else {
				echo '<script> alert("The User Profile you have selected cannot be found."); window.location.href="userProfile.php"; </script>';
			}
		}
		
		function callDeleteUserProfile($id){
			$this->deleteUserProfile($id);
		}
	}
?>