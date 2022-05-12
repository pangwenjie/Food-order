<?php 
include('partials/menu.php');
include('database.php');
include('class-menu-items.php');
?>
<style> 

table{ 
    width:100%;
}

table tr th {
  border-bottom: 1px solid black;
  padding:1%; 
  text-align:left;
}

table tr td{ 
    padding :1%;
}

.btn-primary{
    background-color: #1e90ff;
    padding: 1%;
    color: white;
    text-decoration:none;
    font-weight:bold;
}

.btn-primary:hover{ 
    background-color: #3742fa;
}

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

.btn-danger{
    background-color: #ff6b81;
    padding: 1%;
    color: white;
    text-decoration:none;
    font-weight:bold;
}

.btn-danger:hover{ 
    background-color: #ff4757;
}
</style> 
<div class = "main-content"> 
            <div class = "wrapper"> 
                    <h3>Manage Menu Items  </h3> 

                    <br/> <br/>

                    <!--Button to add admin --> 
                    <a href = "add-menu-item.php" class ="btn-primary"> Add New Menu Items </a>  

                    <br/> <br/> <br/>
                    <table>
                    <tr>
                        <th >S.N. </th> 
                        <th>Menu</th> 
                        <th>Item Name </th> 
                        <th>Price </th> 
                        <th>Image </th> 
                        <th>Description </th> 
                        <th>Availability </th> 

                    </tr>

                    <?php
                        $menuItem = new menuItem();
                        $datas = $menuItem->getAllMenuItem();
                         $sn = 1;
                         foreach($datas as $data){
                            $id = $data['id'];
                            $menuid = $data['menuId'];
                            $title = $data["item_name"];
                            $image_name = $data["image"];
                            $description = $data["description"];
                            $price = $data["price"];
                            $availability = $data["availability"];
                    ?>
                        <tr> 
                            <td><?php echo $sn++ ?> </td>
                            <td><?php echo $menuid; ?> </td>
                            <td><?php echo $title; ?> </td>
                            <td>$<?php echo $price; ?> </td>
                            <td><?php 
                            if($image_name == ""){
                                    echo "No Image Added"; 
                                } 
                            else 
                                { 
                                ?>
                            <img src ="<?php echo "http://localhost:81/food-menu/";?>images/food/<?php echo $image_name; ?>" width ="100px">
                            <?php
                            }
                            ?> </td>
                                    <td><?php echo $description; ?> </td>
                                    <td><?php echo $availability; ?> </td>
                                    <td> <a href = "<?php echo "http://localhost:81/food-menu/restaurantManager/"; ?>update-menu-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class = "btn-secondary" >Update  </a>
                                    <a href = "<?php echo "http://localhost:81/food-menu/restaurantManager/"; ?>delete-menu-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name ?>" class = "btn-danger" > Delete  </a> 
                                </td>
                            </tr>
                         <?php

                        }
                  
                  
        ?>
                
            </table> 
        </div> 
</div> 

 <?php include('partials/footer.php');?>

    