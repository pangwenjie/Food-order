<?php include('partials-front/menu.php');?>

<?php
	ob_start();
	
	$host = "localhost";
	$user = "root";
	$password = "";
	$db = "food-order";
	
	$conn = mysqli_connect($host, $user, $password, $db);
	
	if(!isset($_SESSION['name']) && !isset($_SESSION['userType'])) {
		header("location: loginPage.php");  
	} 
	
	function __destruct() {
	   mysql_close($this->connection);
	}
?>

	<head>
		<style>			
			h1 {text-align: center;
				width: 70%;
				margin-left: auto;
				margin-right: auto;
			}
				
			.table2,
			th,
			td {border:1px black solid;
				border-collapse: collapse;
				padding: 10px;
				background-color: #FFFFFF;
				margin-left:auto;
				margin-right:auto;
			}
			
			.errorMessage {
				font-style: italic;
				color: red;
			}
			
			.btn-primary{
                background-color: #1e90ff;
                padding: 1.5%;
                color: white;
                text-decoration:none;
                font-weight:bold;
				font-size:15px;
            }

            .btn-primary:hover{ 
                background-color: #3742fa;
            }
                  
			
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
		<script>
						
			function validateForm(){
				var name = document.getElementById("name").value;

				if (name == '') {
					document.getElementById("nameErrorMessage").innerHTML = "Name must not be empty.";
					document.getElementById("nameError").value = false;
					return false;
				} else if (/^[a-zA-Z]{1,50}*$/.test(name) == false) {
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
	</head>
	<body class="bodyColour";>
		<h1 width="70%">
			User Profile
		</h1>
			<form method="POST" action="" onsubmit="return validateForm(this)" id="addForm">
				<table id="addTable" class="table2" width="70%" align="center">
					<tr>
						<th colspan="2">Add User Profile</td>
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
						<td colspan="2" align="center"> 
							<button type="submit" class="btn-primary" id="addUserProfileButton" style="margin-right: 70px;"> Create User Profile </button>
							<button type="button" class="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href='systemAdmin.php'"> Back  </button>
						</td>
					</tr>
				</table>
			</form>
			<?php
				if((isset($_POST['nameError']) !== '')){
						if((isset($_POST['nameError']) == true)){
								$name = $_POST['name'];
								
								$sql1 = "SELECT * FROM userprofile
										 WHERE Name = '".$name."'";
								
								$result1 = $conn->query($sql1);
								
								if($result1->num_rows == 0){
									$sql = "INSERT INTO userprofile (name) 
											VALUES('".$name."')";
									
									$result = $conn->query($sql);
									
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
			?>
	</body>
</html>
<?php include('partials-front/footer.php');?>