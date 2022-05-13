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
				width: 70%;
				margin-left: auto;
				margin-right: auto;
			}		
			
			.table2,
			th,
			td {border:1px black solid;
				border-collapse: collapse;
				padding: 10px;
				background-color: #FFFFF;
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
			<?php
				$fragment = $_GET['userProfileId'];
				$sql = "SELECT * FROM userProfile WHERE Id = '".$fragment."'";
				$result = $conn->query($sql);
				
				if($result->num_rows == 1) {
					while($row = mysqli_fetch_array($result)) {
						$name = $row['Name'];
					}
				} else {
					echo 'alert("The User Profile you have selected cannot be found."); window.location.href="userProfile.php";';
				}
			?>
		</script>
	</head>
	<body class="bodyColour";>
		<h1 width="70%">
			Delete User Profile 
		</h1>
			<form method="POST" action="" onsubmit="return true" id="deleteForm">
				<table id="deleteTable" class="table2" width="70%" align="center">
					<tr>
						<th colspan="2">Confirm Delete User ?</td>
					</tr>
					<tr>
						<td width="30%">Name:</td>
						<td width="100%">
							<?php echo $name?>
							<input size="20" type="hidden"  name="nameError" id="nameError">
							<span id="nameErrorMessage" class="errorMessage"></span>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"> 
							<button type="submit" class="btn-primary" id="deleteUserProfileButton" style="margin-right: 70px;"> Delete User Profile </button>
							<button type="button" class="btn-primary" id="backButton" style="margin-left: 70px;" onClick="location.href='userProfile.php'"> Back  </button>
						</td>
					</tr>
				</table>
			</form>
			<?php
				if((isset($_POST['nameError']) !== '')){
					if((isset($_POST['nameError']) == true)){
						$sql = "DELETE FROM userProfile WHERE Id = '".$fragment."'";
						
						$result = $conn->query($sql);
						
						if ($result === TRUE) {
							echo '<script>alert("User Profile deleted successfully"); window.location.href="userProfile.php";</script>';
						} else {
							echo '<script>alert("Error: "' . $sql . '"<br>"' . $conn->error;')</script>';
						}
					}
				}
				?>
	</body>
</html>

<?php include('partials-front/footer.php');?>