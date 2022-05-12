<?php 
include('partials/menu.php');
include('database.php');
include('class-promo.php');
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
                    <h3>Add New Promo Code</h3> 

                    <br/> <br/>

                    <!--Button to add admin --> 
                    <form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Promo Code: </td> 
                                <td><input type ="text" name = "promo" placeholder = "Enter Promo Code"></td>
                            </tr> 

                        
                            <tr> 
                                <td> Discount value: </td> 
                                <td><input type ="number" name = "discount" step = ".01"></td>             
                            </tr> 

                         
                            <tr> 
                                <td> Availability: </td> 
                                <td> <input type ="radio" name ="availability" value = "1">Yes
                                     <input type ="radio" name ="availability" value = "0">No
                                </td> 
                            </tr> 
                            <tr> 
                                <td colspan = "2"> 
                                    <input type = "submit" name="submit" value ="Add Promo Code" class="btn-secondary">
                                </td> 
                               
                            </tr> 
                        </table> 

                    </form> 

                    <?php 
                        if (isset($_POST['submit'])){

                            $promo_code = $_POST['promo'];
                            $discount =$_POST['discount'];
                            $availability = $_POST['availability'];

                    
                            if(isset($_POST['availability'])){
                                $availability = $_POST['availability'];
                            }
                            else 
                            {
                                $availability = "0";
                            }
                            $promo = new promo();
                            $promo->addPromo($promo_code, $discount, $availability);
                        }

                    ?>

             </div> 
        </div> 

<?php include('partials/footer.php');?>
