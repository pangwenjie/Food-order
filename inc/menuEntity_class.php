<?php
class menuEntity extends Database{
    // Retrieve menu items from database to pass back to controller class for processing.
    protected function getMenu(){
        // Retrieve information from the database.
        $sql =  "SELECT `menu_item`.*, `menu`.`title` 
                FROM `menu_item` INNER JOIN `menu` ON `menu_item`.`menuId`=`menu`.`id`";
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