<?php include('partials-front/menu.php');?>

<?php	
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
				
			.table1,
			th,
			td {border:1px black solid;
				border-collapse: collapse;
				padding: 0px;
				text-align: center;
			}
			
			.table_id_length{padding-left: 10%}
			
			.errorMessage {
				font-style: italic;
				color: red;
			}
			
			div.dataTables_wrapper {
				width: 70%;
				margin: auto;
			}
			
		
			
			.titleColour {
				background-color: #8EE4AF;
			}
			
			.sorting_asc {
				background-color: #8EE4AF;
			}
			
			.sorting {
				background-color: #8EE4AF;
			}
			
			.dataTables_empty {
				background-color: #8EE4AF;
			}

			.btn-primary{
                background-color: #1e90ff;
                padding: 2.5%;
                color: white;
                text-decoration:none;
                font-weight:bold;
				font-size:17px;
            }

            .btn-primary:hover{ 
                background-color: #3742fa;
            }
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
		<script>
			var userProfileId = 0;
			
			$(document).ready( function () {
				$('#table_id').DataTable();
				
				$("#table_id").on("click", ".clickable-row", function() {
					userProfileId = $(this).attr("id");	
					$('tr').css('background-color', '#8EE4AF');
					$(this).closest('tr').css('background-color', '379683');
				});
			} );	

			function modifyUserProfile(){
				if (userProfileId != "0") {
					localStorage.setItem("userProfileId", userProfileId);
					window.location.href="modifyUserProfile.php?userProfileId=" + userProfileId;
				} else {
					alert("Please select a user profile to modify.");
				}
			}
			
			function deleteUserProfile(){
				if (userProfileId != "0") {
					window.location.href="deleteUserProfile.php?userProfileId=" + userProfileId;
				} else {
					alert("Please select a user profile to delete.");
				}
			}
		</script>
	</head>
	<body class="bodyColour";>
		<h1 width="70%">
			 User Profile
		</h1>
			<table id="table_id" class="table1" width="100%" align="center">
				<thead>
					<tr class="titleColour">
						<td colspan="7" align="center">User Profile List</td>
					</tr>
					<tr class="titleColour">
						<td colspan="7" align="center">
							<button type="button" class = btn-primary id="bookButton" onClick="location.href='adduserProfile.php';">Create User Profile</button>
							<button type="button" class = btn-primary id="modifyButton" onClick="modifyUserProfile()">Modify User Profile</button>
							<button type="button"class = btn-primary id="cancelButton" onClick="deleteUserProfile()">Delete User Profile</button>
						</td>
						
					</tr>
					<tr>
						<th>Name</th>
					</tr>
				</thead>
				<tbody>
                    <?php
						$sql = "SELECT * FROM userprofile";
						
						$result = $conn->query($sql);
						
						$counter = 1;
						
						while($row = mysqli_fetch_array($result)) {
							?>

					<tr style="background-color: #8EE4AF;"; class='clickable-row' id="<?php echo $row['Id']?>">
						<td><?php echo $row['Name']?></td>
                    </tr>

					<?php $counter++; } ?>
				</tbody>
			</table>
	</body>
</html>
<?php include('partials-front/footer.php');?>