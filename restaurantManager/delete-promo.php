<?php 
include('database.php');
include('class-promo.php');


if(isset($_GET['id'])){
    $id = $_GET['id'];

    $deletePromo = new promo();
    $deletePromo->deletePromo($id);
}


?> 