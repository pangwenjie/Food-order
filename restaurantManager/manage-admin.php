<?php include('partials/menu.php');?>
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
                    <h3>Manage Admin  </h3> 

                    <br/> <br/>

                    <!--Button to add admin --> 
                    <a href = "add-admin.php" class ="btn-primary"> Add New Admin </a>  

                    <br/> <br/> <br/>
                    <table>
                    <tr>
                        <th >S.N. </th> 
                        <th>Full Name</th> 
                        <th >Username </th> 
                        <th  >Actions </th> 
                    </tr>

                    <?php
                        $sql = "SELECT  * from tbl_restaurant_manager";
                        $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
                        $result = mysqli_query($conn, $sql) or die(mysql_error());     
                        
                        if($result == TRUE){
                            $count = mysqli_num_rows($result);
                            $sn = 1;
                            if($count > 0) { 
                                while ($rows = mysqli_fetch_assoc($result)){
                                    $id = $rows['id'];
                                    $full_name = $rows["full_name"];
                                    $username = $rows["username"];

                                    ?>
                                         <tr> 
                                            <td><?php echo $sn++ ?> </td>
                                            <td><?php echo $full_name; ?> </td>
                                            <td><?php echo $username; ?> </td>
                                            <td> <a href = "<?php echo "http://localhost:81/food-menu/admin/"; ?>update-admin.php?id=<?php echo $id; ?>" class = "btn-secondary" >Update  </a>
                                                <a href = "<?php echo "http://localhost:81/food-menu/admin/"; ?>delete-admin.php?id=<?php echo $id; ?>" class = "btn-danger" > Delete  </a> 
                                            </td>
                                        </tr>
                                    <?php

                                }
                            } else {

                            }
                        }else{ 

                        }
                  
                    ?>


                    
                
                    </table> 
             </div> 
        </div> 

 <?php include('partials/footer.php');?>

    