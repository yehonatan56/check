<?php
/*
class server {

    private $servername = 'localhost';
        private $username = 'root';
    private $password = '';
    private $dbName = 'yrcp';
    public $connection;
    
    function __construct() {
-//header('Content-Type: application/json');
    } 

    function getAllTodos() {
        $sql = "UPDATE howmeny SET count = count + 1 WHERE address = ";
        $result = $this->connection->query($sql);

        $dataRows = array();

   
}


}
*/
$mysqli = new mysqli("localhost","root","","yrcp");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Perform query
if ($result = $mysqli -> query("SELECT * FROM Persons")) {
  echo "Returned rows are: " . $result -> num_rows;
  // Free result set
  $result -> free_result();
}

$mysqli -> close();
?>