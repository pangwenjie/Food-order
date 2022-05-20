<?php
class staffController extends staffEntity{
    protected function retrieveOpenOrders(){
        // Call entity class to retrieve ID of open orders.
        $openOrder = $this->getOpenOrdersID();
        $orderItem = array();

        // For each ID, retrieve the items tagged to the ID and push them into their respective array.
        for($i=0; $i<count($openOrder); $i++){
            $orderItem = $this->getOrderItems($openOrder[$i]['id']);
            $openOrder[$i]+= $orderItem;
        }
        
        return $openOrder;
    }
    
    protected function retrieveAndCloseOrder($orderId){
        // Retrieve the current time
        $closed_at = date('Y-m-d H:i:s');
        $closed_at = (string)$closed_at;

        // Establish SQL query
        $sql = "UPDATE `order` SET `status` = '0', `closed_at` ='$closed_at' WHERE `order`.`id` = $orderId;";

        // Call entity class to run sql query
        $entity = $this->closeOrder($sql);
        return true;
    }
}
?>