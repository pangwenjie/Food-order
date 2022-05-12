<?php include('partials/menu.php');?>

        <div class = "main-content"> 
            <div class = "wrapper"> 
                    <h3>DASHBOARD </h3> 
                    <div class = "col-4 text-center"> 

                        <?php 
                            $sql = "SELECT * from menu";

                            $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
                            $result = mysqli_query($conn, $sql) or die(mysql_error());     
                            
                            $count = mysqli_num_rows($result);                
                        ?>
                        <h1> <?php echo $count ?> </h1> 
                        <br/> 
                        Menu
                    </div>

                    <div class = "col-4 text-center"> 

                             <?php 
                                $sql2 = "SELECT * from menu_item";

                                $conn2 = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
                                $result2 = mysqli_query($conn2, $sql2) or die(mysql_error());     
                                
                                $count2 = mysqli_num_rows($result2);                
                            ?>
                        <h1> <?php echo $count2 ?> </h1> 
                        <br/> 
                        Menu Items
                    </div>

                    <div class = "col-4 text-center"> 
                        <h1> 5 </h1> 
                        <br/> 
                        Total Orders
                    </div>

                    <div class = "col-4 text-center"> 
                        <h1> 5 </h1> 
                        <br/> 
                        Total Revenue
                    </div>
                    <div class ="clearfix"></div> 
             </div> 
        </div> 

 <?php include('partials/footer.php');?>

    