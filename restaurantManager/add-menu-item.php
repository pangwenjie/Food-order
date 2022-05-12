<?php 
include('partials/menu.php');
include('database.php');
include('class-menu-items.php');
include('class-menu.php');

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
<div class = "main-content"> 
            <div class = "wrapper"> 
                    <h3>Add New Menu Item</h3> 

                    <br/> <br/>

                    <!--Button to add admin --> 
                    <form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Item Name: </td> 
                                <td><input type ="text" name = "title" placeholder = "Enter Food Name"></td>
                            </tr> 

                            <tr> 
                                <td> Description: </td> 
                                <td><textarea name ="description" cols="30" rows="5" placeholder = "Enter Food Description"></textarea></td>
                            </tr> 

                            <tr> 
                                <td> Price: </td> 
                                <td><input type ="number" name = "price" step = ".01"></td>             
                            </tr> 

                            <tr> 
                                <td> Select Image: </td> 
                                <td><input type ="file" name = "image">
                                </td>
                            </tr>

                            <tr> 
                                <td> Menu: </td> 
                                <td> <select name ="menu">
                                    <?php 
                                        $menu = new menu();
                                        $datas = $menu->getAllMenu();
                                        foreach($datas as $data){
                                              $id = $data['id'];
                                              $title = $data['title'];
                                        ?>
                                     <option value = "<?php echo $id; ?>"> <?php echo $title; ?></option> 
                                          <?php
                                        }
                                    ?>
                            
                                </td> 
                            </tr> 
                            <tr> 
                                <td> Availability: </td> 
                                <td> <input type ="radio" name ="availability" value = "1">Yes
                                     <input type ="radio" name ="availability" value = "0">No
                                </td> 
                            </tr> 
                            <tr> 
                                <td colspan = "2"> 
                                    <input type = "submit" name="submit" value ="Add Menu Item" class="btn-secondary">
                                </td> 
                               
                            </tr> 
                        </table> 

                    </form> 

                    <?php 
                        if (isset($_POST['submit'])){

                            $item_name = $_POST['title'];
                            $description =$_POST['description'];
                            $price = $_POST['price'];
                            $menu = $_POST['menu'];
                    
                            if(isset($_POST['availability'])){
                                $active = $_POST['availability'];
                            }
                            else 
                            {
                                $active = "No";
                            }

                            if(isset($_FILES['image']['name'])){
                                $image_name = $_FILES['image']['name'];

                                if($image_name != ""){

                                    $tmp = explode('.',$image_name);
                                    $ext = end($tmp);
                                    $image_name = "Food_Name_".rand(000, 999).'.'.$ext;
                                    $source_path = $_FILES['image']['tmp_name']; 
                                    $destination_path = "../images/food/".$image_name;

                                    $upload = move_uploaded_file($source_path, $destination_path);

                                    if($upload == false)
                                    {
                                        header("location:http://localhost:81/food-menu/admin/add-menu-item.php");
                                        die();
                                    }
                                }
                            }
                            else
                            {
                                $image_name = "";
                            }

                            $menuItem = new menuItem();
                            $menuItem->addMenuItem($menu, $item_name, $image_name, $description, $price, $active);
                           
                        }

                    ?>

             </div> 
        </div> 

<?php include('partials/footer.php');?>
