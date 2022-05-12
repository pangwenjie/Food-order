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
    <h1> Manage Category </h1> 
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];

                $menu = new menu();
                $datas = $menu->getMenu($id); 

                foreach($datas as $data){
                    $title = $data['title'];
            }
        }
        ?> 


    <br/> <br/> 
<!-- Category form starts here-->
    <form action ="" method = "POST" enctype ="multipart/form-data" > 
                        <table> 
                            <tr> 
                                <td> Title: </td> 
                                <td><input type ="text" name = "title" value ="<?php echo $title?>"></td>
                            </tr> 

                            <tr> 
                                <td colspan="2"> 
                                <input type ="hidden" name = "id" value="<?php echo $id ?>"> 
                                <input type ="submit" name = "submit" value= "Update Menu" class="btn-secondary">    
                            </tr> 
                        </table> 

                    </form> 

    </div> 
    </div> 


<?php include('partials/footer.php');?>



<?php 

if(isset($_POST['submit']))
{
     $id = $_POST['id'];
     $title = $_POST['title'];
     
     $menu = new menu();
     $menu->updateMenu($id, $title); 

}
?>