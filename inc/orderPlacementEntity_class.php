<?php
class orderPlacementEntity extends Database{
    protected function insertOrder($sql){
        // Initialize variables
        $query = $sql['query'];
        $date = $sql['created_at'];   

        // Insert new order into `order` table. 
        $this->connect()->query($sql['query']);

        // Retrieve order number
        $userId = $_SESSION['userId']; // To change once login/register is implemented.
        $newQuery = "SELECT `order`.`id` FROM `order` 
                     WHERE `userId`='$userId' 
                     AND `created_at` LIKE '$date%' 
                     AND `status`=1
                     AND `id`=(SELECT MAX(`id`) FROM `order`);";
        
        $orderNo = $this->connect()->query($newQuery);

        // Get numbers of the rows from the returned query table.
        $numRows = $orderNo->num_rows;

        // With the number of rows, transform the table into a assocative array.
        if ($numRows > 0) {
            while ($row = $orderNo->fetch_assoc()) {
                $data = $row['id'];
            }
            
        // Return assocative array.
        return $data;
        }
    }

    protected function insertOrderItem($sql){
        foreach ($sql as $query){
            $this->connect()->query($query);
        }
    }

    protected function getOrder($sqls){
        foreach($sqls as $sql){
            // Retrieve information from the database.
            $result = $this->connect()->query($sql);

            // Get numbers of the rows from the returned query table.
            $numRows = $result->num_rows;

            // With the number of rows, transform the table into a assocative array.
            if ($numRows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
            }
        }
        // Return assocative array.
        return $data;
    }
}
?>