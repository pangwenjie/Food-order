<?php
 	session_start();
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



		<script>
			setTimeout(function () {
			   window.location.href= 'loginPage.php';
			}, 0);
		</script>

		<h1>Restaurant Maintenance System</h1>
				<div class="message">You have successfully logout.</div>
			<?php
					if((isset($_SESSION['name']))){		
						session_destroy();
						unset($_SESSION["name"]);
						unset($_SESSION["userType"]);
						exit;
					}
				
			?>

