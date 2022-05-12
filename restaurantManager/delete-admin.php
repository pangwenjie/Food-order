 <?php 

     $id = $_GET['id'];

      $sql = "DELETE FROM tbl_restaurant_manager WHERE id = $id";
      $conn = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
      $result = mysqli_query($conn, $sql) or die(mysql_error());

      if($result == TRUE){
          header("location:http://localhost:81/food-menu/admin/manage-admin.php");
      }else{ 
          header("location:http://localhost:81/food-menu/admin/manage-admin.php");
      }

?>