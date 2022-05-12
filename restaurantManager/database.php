<?php 
class database { 
    private $servername;
    private $username;
    private $password;
    private $dbname; 

    protected function connect($sql){ 
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "food-order";

        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die(mysql_error());
        $result = mysqli_query($conn, $sql) or die(mysql_error());     
        return $result;
    }
}
?>   