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
                padding: 3.5%;
                color: white;
                text-decoration:none;
                font-weight:bold;
				font-size:20px;
            }

            .btn-primary:hover{ 
                background-color: #3742fa;
            }
                                
		</style>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
		<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
		<script>
			var sessionId = 0;
			
			$(document).ready( function () {
				$('#table_id').DataTable();
				
				$("#table_id").on("click", ".clickable-row", function() {
					sessionId = $(this).attr("id");	
					$('tr').css('background-color', '#8EE4AF');
					$(this).closest('tr').css('background-color', '379683');
				});
			} );	

		</script>
	</head>
	<body class="bodyColour";>
		<h1 width="70%">
			System Admin Dashboard
		</h1>
			<table id="table_id" class="table1" width="100%" align="center">
				<thead>
					<tr class="titleColour">
						<td colspan="7" align="center">
							<button type="button" class="btn-primary" id="userProfileButton" onClick="location.href='userProfile.php';">User Profile</button>
							<button type="button" class="btn-primary" id="userButton" onClick="modifySession()">User</button>
							<button type="button" class="btn-primary" id="cancelButton" onClick="cancelSession()">Cancel Session</button>
						</td>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
	</body>

	<?php include('partials-front/footer.php');?>