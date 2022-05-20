<?php
class staffEntity extends Database{
    protected function getOpenOrdersID(){
        // Retrieve open orders from the database.
        $sql =  "SELECT `order`.`id`, `userdirectory`.`Name`,`order`.`table_code`, `order`.`comment`, `order`.`grand_total`, `order`.`total`
                 FROM `order` INNER JOIN `userdirectory` ON `order`.`userId`=`userdirectory`.`UserId` 
                 WHERE STATUS = 1 ORDER BY `id` ASC;";
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

    protected function getOrderItems($orderID){
        // Retrieve order items associated with orderID.
        $sql = "SELECT `menu_item`.`item_name`, `menu_item`.`price`, `order_item`.`quantity`
                FROM `menu_item` INNER JOIN `order_item` ON `menu_item`.`id` = `order_item`.`itemId`
                WHERE `order_item`.`orderId`=$orderID;";
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

    protected function closeOrder($sql){
        $this->connect()->query($sql);
        return true;
    }
}
?>