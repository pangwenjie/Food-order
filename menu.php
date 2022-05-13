<?php
    // Include classes
    include 'inc/Database_class.php';
    include 'inc/menuEntity_class.php';
    include 'inc/menuController_class.php';
    include 'inc/menuBoundary_class.php';
    //include 'inc/header.php';
    include('partials-front/menu.php');
?>

    <section class="food-search text-center">
        <div class="container">
     
        </div>
    </section>
   
    <?php 
    // Retrieve menu information from entity class through control class.
    $menuGUI = new menuBoundary;

    // Display user interface
    $menuGUI->requestMenu();
    echo "<hr width=700px>";

    // Include footer of the page.
    include 'inc/footer.php';
?>