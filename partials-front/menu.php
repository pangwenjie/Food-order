<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="menu.php">Menu</a>
                    </li>
                    <li>
                    <?php
                        if(isset($_SESSION["name"])) {?>
                        <a href="logoutPage.php" tite="Logout">Logout </a> 
                        <?php }else{ ?><a href="loginPage.php" tite="Login">Login</a>
                        <?php
                        }
                        ?>
                       <!-- <a href="loginPage.php">Login</a> -->
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>