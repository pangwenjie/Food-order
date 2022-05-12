<?php 

class promo extends database { 
 
    public function getAllPromo(){
        $sql = "SELECT  * from promo_code";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}
    public function getPromo($id){ 
        $sql = "SELECT * FROM promo_code where id='$id'";
        $result = $this->connect($sql);
        $numRows = $result->num_rows;

        if($numRows > 0){
            while ($rows = $result->fetch_assoc()){
                $data[] = $rows;
        }
        return $data;
    }
}

    public function addPromo($promo_code, $discount, $availability){ 
        $sql = "INSERT INTO promo_code SET 
                id = '$promo_code',
                discount = '$discount',
                availability = '$availability'
                ";

        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/add-promo.php");
        }
    }

    public function updatePromo($newid, $discount, $availability, $id){ 
        $sql2 = "UPDATE promo_code SET
            id = '$newid', 
            discount = '$discount', 
            availability = '$availability'
            where id='$id'
        ";
        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/add-promo.php");
        }
    }

    public function deletePromo($id){ 
        $sql = "DELETE FROM promo_code WHERE id = '$id'";
        $result = $this->connect($sql);

        if($result == true){
            header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
        }else{
            header("location:http://localhost:81/food-menu/restaurantManager/manage-promo.php");
        }
    }


}



