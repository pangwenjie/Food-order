<?php 
include('partials/menu.php');
include('database.php');
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
<div class="main-content"> 
    <div class ="wrapper"> 
    <h1> Add Menu </h1> 
    <br/> <br/> 
<!-- Category form starts here-->
    <form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Title: </td> 
                                <td><input type ="text" name = "title" placeholder = "Enter menu title"></td>
                            </tr> 

                            <td colspan = "2"> 
                                <input type = "submit" name="submit" value ="Add Menu" class="btn-secondary">
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
     $title = $_POST['title'];
     $newMenu = new menu();
     $newMenu->addMenu($title);
}

?>