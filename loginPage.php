<?php include('partials-front/menu.php');?>
<?php
    ob_start();
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "food-order";
	
	$conn = mysqli_connect($host, $user, $password, $db);
	
	function __destruct() {
	   mysql_close($this->connection);
	}
?>

	<head>
		<style>			
			h1 {text-align: center;
				text-decoration: underline;
			}
				
			.table1,
			th,
			td {border:1px black solid;
				border-collapse: collapse;
				padding: 30px;
                margin-left:auto;
                margin-right:auto;
			}
			
			.errorMessage {
				font-style: italic;
				color: red;
			}   

            .btn-primary{
                background-color: #1e90ff;
                padding: 3%;
                color: white;
                text-decoration:none;
                font-weight:bold;
				font-size:15px;
            }

            .btn-primary:hover{ 
                background-color: #3742fa;
            }
                                
		</style>
		<script>
			function validateCredentials() {
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
						return false;
					} else if (/^.{8,12}$/.test(password) == false) {
						document.getElementById("passwordErrorMessage").innerHTML = "Password must be between 8 - 12 characters";
						return false;
					} else if (/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$/.test(password) == false) {
						document.getElementById("passwordErrorMessage").innerHTML = "Password must have at least 1 uppercase, 1 lowercase, 1 number and 1 symbol.";
						return false;
					} else {
						document.getElementById("passwordErrorMessage").innerHTML = "";
					}
					
					return true;
				}
		</script>
	</head>
	<section class="food-search text-center">
        <div class="container">
     
        </div>
    </section>
    <section class="food-menu">
	<body class="bodyColour";>
		<h1> Login to account:</h1>
        <br/>
			<form method="POST" action="" onsubmit="return validateCredentials(this)">
				<table class="table1" width="20%" align="center">
					<tr>
						<td width="30%">Username:</td>
						<td width="70%">
							<input size="18" type="text"  name="name" id="name">
							<input size="18" type="hidden"  name="nameError" id="nameError">
							<span id="nameErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td>Password:</td>
						<td>
							<input size="18" type="password"  name="password" id="password">
							<input size="18" type="hidden"  name="passwordError" id="passwordError">
							<span id="passwordErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button type="submit" id="loginButton" class = "btn-primary" onClick="validateCredentials()">Login</button>
							<span id="loginMessage" class="errorMessage"></span>
						</td>
					</tr>
					
				</table>
			</form>
    </section>
			<?php
			if((isset($_POST['nameError']) !== '') && (isset($_POST['passwordError']) !== '')){
				if((isset($_POST['nameError']) == true) && (isset($_POST['passwordError']) == true)){
					$username = $_POST['name'];
					$password = $_POST['password'];
					
					$sql = "SELECT * FROM userdirectory WHERE Name = '".$username."' AND Password = '".$password."' limit 1";
					
					$result = $conn->query($sql);
					
					if($result->num_rows == 1){
						echo "You have logged in";
														
						while($row = mysqli_fetch_array($result)){
							$_SESSION['name'] = $username;
							$_SESSION['userId'] = $row['UserId'];
							if($row["UserType"] == "System Admin"){
								header('location: systemAdmin.php');
							} else if($row["UserType"] == "Restaurant Staff"){
								header('location: staffinterface.php');
								$_SESSION['userType'] = "staff";
							}else if($row["UserType"] == "Restaurant Manager"){
								header('location: restaurantManager/index.php');
								$_SESSION['userType'] = "staff";
							}else if($row['userType'] = "Customer"){
								header('location: menu.php');
								$_SESSION['userType'] = "staff";
							} else {
						echo '<script>alert("You have failed to login")</script>'; 
					}
				}
			}
		}
	}
			ob_flush();
			?>
	</body>

</html>

<?php include('partials-front/footer.php');?>