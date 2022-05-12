<?php
include('partials/menu.php');
include('database.php');
include('class-menu.php');
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
                    <h3>Manage Menu</h3> 
            <br/> <br/>
        <!--Button to add admin --> 
        <a href = "add-menu.php" class ="btn-primary"> Add New Menu </a>  

        <br/> <br/> <br/>
        <table>
        <tr>
            <th >S.N. </th> 
            <th> Title </th>  
        </tr>
        <?php
                $menu = new menu();
                $datas = $menu->getAllMenu(); 
                $sn = 1;
                foreach($datas as $data){
                    $id = $data['id'];
                    $title = $data['title'];
                ?>
                 <tr> 
                      <td><?php echo $sn++ ?> </td>
                      <td><?php echo $title; ?> </td>
                      <td> <a href = "<?php echo "http://localhost:81/food-menu/restaurantManager/"; ?>update-menu.php?id=<?php echo $id; ?>" class = "btn-secondary" >Update  </a>
                            <a href = "<?php echo "http://localhost:81/food-menu/restaurantManager/"; ?>delete-menu.php?id=<?php echo $id; ?>" class = "btn-danger" > Delete  </a> 
                        </td>
                    </tr>
                <?php
            }         
        ?>
        </table> 
             </div> 
        </div> 

 <?php include('partials/footer.php');?>

    