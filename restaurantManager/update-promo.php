<?php
include('partials/menu.php');
include('database.php');
include('class-promo.php');?>
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
    <h1> Update Promo Code Details </h1> 
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $promo = new promo();
                $datas = $promo->getPromo($id); 
                foreach($datas as $data){
                    $discount = $data['discount'];
                    $availability = $data['availability'];
            }
        }
        ?> 


    <br/> <br/> 
<!-- Category form starts here-->
<form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Promo Code: </td> 
                                <td><input type ="text" name = "promo" value="<?php echo $id?>"></td>
                            </tr> 

                        
                            <tr> 
                                <td> Discount value: </td> 
                                <td><input type ="number" name = "discount" step = ".01" value="<?php echo $discount?>"></td>             
                            </tr> 

                         
                            <tr> 
                                <td> Availability: </td> 
                                <td> <input <?php if($availability == "1"){echo "checked";} ?> type ="radio" name ="availability" value = "1">Yes
                                     <input <?php if($availability == "0"){echo "checked";} ?> type ="radio" name ="availability" value = "0">No
                                </td> 
                            </tr> 

                            <tr> 
                                <td colspan = "2"> 
                                    <input type = "submit" name="submit" value ="Add Promo Code" class="btn-secondary">
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
     $newid = $_POST['promo'];
     $discount = $_POST['discount'];
     $availability = $_POST['availability'];
     $id = $_GET['id'];
     
     $sql2 = "UPDATE promo_code SET
             id = '$newid', 
             discount = '$discount', 
             availability = '$availability'
             where id='$id'
             ";

     $conn2 = mysqli_connect('localhost', 'root', '', 'food-order') or die(mysql_eror());
     $result2 = mysqli_query($conn2, $sql2) or die(mysql_error());
 
     if($result2 == TRUE){
        header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
    }else{ 
        header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
    }

}

?>

