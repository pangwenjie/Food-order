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
                    <h3>Add Admin  </h3> 
                    <br/> <br/> 
                    <form action ="" method = "POST" > 
                        <table> 
                            <tr> 
                                <td> Full Name: </td> 
                                <td><input type ="text" name = "full_name" placeholder = "Enter Your Name"></td>
                            </tr> 

                            <tr> 
                                <td> Username: </td> 
                                <td><input type ="text" name = "username" placeholder = "Your Username"></td>
                            </tr> 

                            <tr> 
                                <td> Password: </td> 
                                <td><input type ="password" name = "password" placeholder = "Your Password"></td>
                            </tr> 

                            <tr> 
                                <td colspan = "2"> 
                                    <input type = "submit" name="submit" value ="Add Admin" class="btn-secondary">
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
      $full_name = $_POST['full_name'];
      $username = $_POST['username'];
      $password = $_POST['password'];

      session_start();
      // SQL query to save in DB 
      $sql = "INSERT INTO tbl_restaurant_manager SET full_name = '$full_name', username = '$username', password = '$password'";
      $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
      $result = mysqli_query($conn, $sql) or die(mysql_error());

      if($result == TRUE){
          header("location:http://localhost:81/food-menu/admin/manage-admin.php");
      }else{ 
          header("location:http://localhost:81/food-menu/admin/add-admin.php");
      }

}

?>