<?php
class orderPlacementController extends orderPlacementEntity{
    protected function createOrder($array){
        // Initialize variables
        if ($array['promo']==""){
            $promo = 'nopromo';
        } else {
            $promo = $array['promo']; 
        }
                    
        $comment = $array['comment'];  
        $userId = $_SESSION['userId'];
        $table_code = $array['table_code'];
        $status = 1;
        $total = $array['total']; 
        $grand_total = $array['grand_total'];
        $created_at = date('Y-m-d H:i:s');
        $closed_at = '0000-00-00 00:00:00';

        // Establish the SQL query and pass to entity class.
        $sql['query'] = "INSERT INTO `order` (`id`, `userId`, `promo`, `table_code`, `status`, `comment`, `total`, `grand_total`, `created_at`, `closed_at`) 
                            VALUES (NULL, '$userId', '$promo', '$table_code', '$status', '$comment', '$total', '$grand_total', '$created_at', '$closed_at');";
        $sql['created_at'] = $created_at;
        
        // Call upon entity class to insert new data into order table and return order number.
        $orderId = $this->insertOrder($sql);

        // Tag order items to order number.
        $sql_orderItem = array();

        foreach ($array as $key=>$val){
            // Initialize variables
            if (is_int($key)){
                $itemId = (int)$key;
                $quantity = $val;
                $sql_orderItem[] = "INSERT INTO `order_item` (`id`, `orderId`, `itemId`, `quantity`) 
                                    VALUES (NULL, '$orderId', '$itemId', '$quantity');";
            }  
        }

        //Insert each item into the order ID.
        $this->insertOrderItem($sql_orderItem);

        //Return order number.
        return $orderId;
    } 

    protected function retrieveOrder($array){  
        // Get orderId
        $orderId = $array['orderId'];
        $sql = array();

        // Retrieve order information
        $sql[] = "SELECT `order`.`id`, `order`.`userId`, `order`.`promo`, `order`.`table_code`, `order`.`comment`, `order`.`total`, `order`.`grand_total` 
                FROM `order` 
                WHERE order.id=$orderId";
        
        // Retrieve order items
        $sql[] = "SELECT `menu_item`.`item_name`, `menu_item`.`price`, `order_item`.`quantity`, `menu_item`.`image` 
                  FROM `menu_item` INNER JOIN `order_item` ON `menu_item`.`id` = `order_item`.`itemId`
                  WHERE `order_item`.`orderId` = $orderId";

        //Retrieve information from database.
        $entity = $this->getOrder($sql); 
        return $entity;
    }
}
?>
