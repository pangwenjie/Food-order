<?php
class menuController extends menuEntity{
    protected function retrieveAndFilterMenu(){
        // Obtain data from entity class.
        $entity = $this->getMenu();

        // Initialize empty array.
        $filteredDatas = array();

        // Retrieve records with availability = 1.
        foreach($entity as $data){
            if ($data['availability'] == 1){
                array_push($filteredDatas, $data);
            }
        }

        // Sort filtered data by menu type in ascending order.
        usort($filteredDatas, function($a, $b){
            return $a['menuId'] - $b['menuId'];
        });

        return $filteredDatas;
    }  

    protected function retrieveOrdersInfo($array){
        // Obtain data from entity class
        $datas = $this->getMenu();

        // Initialize empty array
        $result = array();

        // Retrieve records that customer has ordered.
        foreach ($array as $key => $val){
            if ($val > 0){
                $index = array_search($key, array_column($datas, 'id'));
                array_push($result, $datas[$index]);
            }
        }
        return $result;
    }

    protected function checkPromoCode($promoCode){
        // Obtain data from entity class.
        $datas = $this->getPromoCodes();

        // Check if promo code exist in the table.
        foreach($datas as $data){
            if ($promoCode == $data['id']){
                $discount=$data['discount'];
            }
        }
        
        if (isset($discount)){
            return $discount;
        } else {
            return -1;
        }
    }

    protected function getPromoCodes(){
        // Retrieve information from the database.
        $sql = "SELECT * FROM `promo_code`";
        $result = $this->connect()->query($sql);
               
       // Get numbers of the rows from the returned query table.
        $numRows = $result->num_rows;

        // With the number of rows, transform the table into a assocative array.
        if ($numRows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
        }
 
        // Return assocative array.
        return $data;       
        }
    }
}
?>