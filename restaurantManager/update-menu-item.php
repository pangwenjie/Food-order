<?php
ob_start();
include('partials/menu.php');
include('database.php');
include('class-menu-items.php');
?>

<style>
.btn-secondary{
    background-color: #7bed9f;
    padding: 1%;
    color: black;
    text-decoration:none;
    font-weight:bold;
}

.btn-secondary:hover{ 
    background-color: #2ed573;
}
</style>
<div class="main-content"> 
    <div class ="wrapper"> 
    <h1> Update Menu Item </h1> 
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $menuItem = new menuItem();
                $datas = $menuItem->getMenuItem($id);
                foreach($datas as $data){
                    $itemName = $data['item_name'];
                    $description = $data['description'];
                    $price = $data['price'];
                    $current_image = $data['image'];
                    $current_menu = $data['menuId'];
                    $availability = $data['availability'];
                }
            }
        ?> 


    <br/> <br/> 
<!-- Category form starts here-->
    <form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Item Name: </td> 
                                <td><input type ="text" name = "title" value ="<?php echo $itemName?>"></td>
                            </tr> 

                            <tr> 
                                <td> Description: </td> 
                                <td><textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea></td>
                            </tr> 

                            <tr> 
                                <td> Price: </td> 
                                <td><input type="number" name="price" value ="<?php echo $price?>" step = ".01"></td>
                            </tr> 

                            <tr> 
                                <td> Current Image: </td> 
                                <td>
                                    <?php 
                                        if($current_image != ""){
                                            ?> 
                                              <img src = "<?php echo "http://localhost:81/food-menu/"; ?>images/food/<?php echo $current_image; ?>" width = "100px"> 
                                              <?php 
                                        } else { 
                                            echo "<div class='error'>Image not added";
                                        }
                                    ?> 
                                </td>
                            </tr>

                            <tr> 
                                <td> New Image: </td> 
                                <td><input type ="file" name = "image">
                                </td>
                            </tr>

                            
                            <tr> 
                                <td> Menu: </td> 
                                <td> <select name ="menu">
                                    <?php 
                                        $sql = "SELECT * from menu"; 

                                        $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
                                        $result = mysqli_query($conn, $sql) or die(mysql_error());     

                                        $count = mysqli_num_rows($result);
                                        if($count > 0){
                                            while($row = mysqli_fetch_assoc($result)){
                                                $menu_title = $row['title'];
                                                $menu_id = $row['id'];
                                                
                                                ?>
                                                <option <?php if($current_menu == $menu_id){echo "selected";} ?> value ="<?php echo $menu_id; ?>"><?php echo $menu_title; ?></option>
                                                <?php
                                            }

                                        }
                                        else
                                        {
                                            ?>
                                                <option value ="0"> No Category Created </option>
                                            <?php

                                        }

                                    ?>
                            
                                </td> 
                            </tr>

                        
                            <tr> 
                                <td> Availability: </td> 
                                <td> <input <?php if($availability == "1"){echo "checked";} ?> type ="radio" name ="availability" value = "1">Yes
                                     <input <?php if($availability == "0"){echo "checked";} ?> type ="radio" name ="availability" value = "0">No
                                </td> 
                            </tr> 
                            <tr> 
                                <td colspan = "2"> 
                                    <input type = "hidden" name="current_image" value="<?php echo $current_image;?>">
                                    <input type = "hidden" name="id" value="<?php echo $id;?>">
                                    <input type = "submit" name="submit" value ="Update Category" class="btn-secondary">
                                </td> 
                               
                            </tr> 
                        </table> 

                    </form> 

    </div> 
    </div> 


<?php include('partials/footer.php');?>


<?php 

if(isset($_POST['submit']))
{
    $id = $_POST['id'];
     $itemName = $_POST['title'];
     $description = $_POST['description'];
     $price = $_POST['price'];
     $current_image = $_POST['current_image'];
     $menu = $_POST['menu'];
     $availability = $_POST['availability'];

     if(isset($_FILES['image']['name'])){
         $image_name = $_FILES['image']['name'];
         if($image_name!= ""){
            $tmp = explode('.', $image_name);
            $ext = end($tmp);
            $image_name = "Food_Name_".rand(000, 999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name']; 
            $destination_path = "../images/food/".$image_name;
            $upload = move_uploaded_file($source_path, $destination_path);
    
            if($upload == false){
                header("location:http://localhost:81/food-menu/restaurantManager/add-food.php");
                die();
            }
            
            if($current_image != ""){
                $remove_path = "../images/food/".$current_image;
                $remove = unlink($remove_path);
            }
    
         }
         else
         {
             $image_name = $current_image;
         }
     }
     else{
         $image_name = $current_image;
     }

   $menuItem = new menuItem();
   $menuItem->updateMenuItem($menu, $itemName, $image_name, $description, $price, $availability, $id);

 
}