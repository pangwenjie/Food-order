<?php 
include('database.php');
include('class-menu.php');

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $menuitem = new menu();
    $menuitem->deleteMenu($id);
}
?> 