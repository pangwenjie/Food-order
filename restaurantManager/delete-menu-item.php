<?php 
include('database.php');
include('class-menu-items.php');


if(isset($_GET['id']) AND isset($_GET['image_name'])){

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    
    $menuItem = new menuItem();
    $menuItem->unlinkImagePath($image_name);
    $menuItem->deleteMenu($id);

}
?> 