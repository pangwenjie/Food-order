<?php
class Database{
    // Establish private variables.
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
        
    protected function connect() {
        // Set parameter of the variables.
        $this->DB_HOST = "localhost";
        $this->DB_USER = "root";
        $this->DB_PASS = "";
        $this->DB_NAME = "food-order";

        // Establish a connection to database.
        $conn = new mysqli($this->DB_HOST, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

        // Return connection.
        return $conn;
    }
}
?>