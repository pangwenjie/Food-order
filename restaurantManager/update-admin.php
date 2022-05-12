<?php include('partials/menu.php');?>
<style>

table{ 
    width:30%;
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
</style>
        <div class = "main-content">  
            <div class = "wrapper"> 
                    <h3>Update Admin  </h3> 

                    <br/> <br/>


                    <?php 
                        $id = $_GET['id'];

                        $sql = "SELECT * FROM tbl_restaurant_manager where id =$id";

                        $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
                        $result = mysqli_query($conn, $sql) or die(mysql_error());
                  
                        if($result == TRUE){
                            $count = mysqli_num_rows($result);
                            if ($count ==1){
                                $row=mysqli_fetch_assoc($result);

                                $full_name = $row['full_name'];
                                $username = $row['username'];
                            }

                        }else{
                            header("location:http://localhost:81/food-menu/admin/manage-admin.php");
                        }

                    ?>

                    <form action ="" method="POST" > 
                        <table>  

                            <tr> 
                                <td> Full Name: </td> 
                                <td> 
                                    <input type ="text" name = "full_name" value= "<?php echo $full_name ?>"> 
                                </td>   
                            </tr> 

                            <tr> 
                                <td> Username: </td> 
                                <td> 
                                    <input type ="text" name = "username" value= "<?php echo $username ?>"> 
                                </td>   
                            </tr> 


                            <tr> 
                                <td colspan="2"> 
                                <input type ="hidden" name = "id" value="<?php echo $id ?>"> 
                                <input type ="submit" name = "submit" value= "Update Admin" class="btn-secondary">    
                            </tr> 

                        </table>
                    </form> 
             </div> 
        </div> 

<?php 
    if (isset($_POST['submit'])){
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_restaurant_manager set full_name = '$full_name', username = '$username' where id = '$id'";

        $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
        $result = mysqli_query($conn, $sql) or die(mysql_error());
  
        if($result == TRUE){
            header("location:http://localhost:81/food-menu/admin/manage-admin.php");
        }else{
            header("location:http://localhost:81/food-menu/admin/manage-admin.php");
        }
    }

?>




 <?php include('partials/footer.php');?>

    