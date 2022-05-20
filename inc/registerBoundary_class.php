<?php
	class registerBoundary extends registerController{
		public function display(){
			echo '
			<form method="POST" action="" onsubmit="return validateForm(this)" id="addForm">
				<table id="addTable" class="table1" width="50%" align="center">
					<tr>
						<th colspan="2">Register Form</td>
					</tr>
					<tr>
						<td width="30%">Name:</td>
						<td width="100%">
							<input type="text" name="name" id="name" size="20" maxLength="50">
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
							<input type="text" name="email" id="email" size="20" maxLength="50">
							<input size="20" type="hidden"  name="emailError" id="emailError">
							<span id="emailErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"> 
							<button type="submit" class="btn-primary" id="addUserButton" style="margin-right: 70px;"> Register </button>
							<button type="button" class="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href=\'user.php\'"> Back  </button>
						</td>
					</tr>
				</table>
			</form>
			';
		}
		
		function callRegisterAccount(){
			$this->registerAccount();
		}
	}
?>