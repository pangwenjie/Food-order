<?php
    // Include classes
    include 'inc/Database_class.php';
    include 'inc/menuEntity_class.php';
    include 'inc/menuController_class.php';
    include 'inc/menuBoundary_class.php';
    include('partials-front/menu.php');
?>

<section class="food-search text-center">
        <div class="container">
     
        </div>
    </section>
   
<?php 
    // Header of the webpage.
    echo "<br><center><h1> Review Order </h1><br>";
    echo "<hr width='750'><br>";

    // HTML Form
    echo "<table>";
        echo "<tr>";
            $reviewOrder = new menuBoundary;
            $reviewOrder->reviewOrders($_GET);
        echo "</tr>";
    echo "</table>";
    echo "<hr width=750px></center>";
    include 'inc/footer.php';
?>
