<?php 

class menuItem extends database { 
 
    public function getAllMenuItem(){
        $sql = "SELECT  * from menu_item";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}
    public function getMenuItem($id){ 
        $sql = "SELECT * FROM menu_item where id=$id";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}

    public function addMenuItem($menu, $item_name, $image_name, $description, $price, $active){ 
        $sql = "INSERT INTO menu_item SET 
                menuId = '$menu',
                item_name = '$item_name',
                image = '$image_name',
                description = '$description',
                price = $price,
                availability = '$active'
        ";        
        
        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu-item.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/add-menu-item.php");
        }
    }

    public function updateMenuItem($menu, $itemName, $image_name, $description, $price, $availability, $id){ 
        $sql = "UPDATE menu_item SET   
                menuId = '$menu',
                item_name = '$itemName',
                image = '$image_name', 
                description = '$description',
                price = '$price',
                availability = '$availability' 
                where id=$id";

        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu-item.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/update-menu-item.php");
        }
        ob_end_flush();
    }
    

    public function deleteMenu($id){ 
        $sql = "DELETE FROM menu_item WHERE id = $id";
        $result = $this->connect($sql);

        header("location:http://localhost:81/food-menu/restaurantManager/manage-menu-item.php");
        
    
    }

    public function unlinkImagePath($image_name){ 
        $path = "../images/food/".$image_name; 
        unlink($path);
    }


}
