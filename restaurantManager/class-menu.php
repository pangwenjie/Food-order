<?php 

class menu extends database { 
 
    public function getAllMenu(){
        $sql = "SELECT  * from menu";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}
    public function getMenu($id){ 
        $sql = "SELECT * FROM menu where id=$id";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}

    public function addMenu($title){ 
        $sql = "INSERT INTO menu SET title = '$title'";
        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/add-menu.php");
        }
    }

    public function updateMenu($id, $title){ 
        $sql = "UPDATE menu SET title = '$title' where id=$id";
        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/add-menu.php");
        }
    }

    public function deleteMenu($id){ 
        $sql = "DELETE FROM menu WHERE id = $id";
        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/manage-menu.php");
        }
    }


}



