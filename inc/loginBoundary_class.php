<?php
	class loginBoundary extends loginController {
		public function display() {
			echo '
			<form method="POST" action="" onsubmit="return validateAcc(this)">
				<table class="table1" width="20%" align="center">
					<tr>
						<td width="30%">Username:</td>
						<td width="70%">
							<input size="20" type="text"  name="name" id="name">
							<input size="20" type="hidden"  name="nameError" id="nameError" value="false">
							<span id="nameErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input size="20" type="password"  name="password" id="password">
							<input size="20" type="hidden"  name="passwordError" id="passwordError">
							<span id="passwordErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button type="submit" class = "btn-primary" id="loginButton" onClick="validateAcc()">Login</button>
							<span id="loginMessage" class="errorMessage"></span>
						</td>
					</tr>
				</table>
			</form>
			';
		}
		
	}
?>