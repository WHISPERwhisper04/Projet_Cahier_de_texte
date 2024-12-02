<?php
class Connection{
private $servername="localhost";
private $username="root";
private $password="";
public $conn;
public function __construct(){
    // Create connection
    $this->conn = mysqli_connect($this->servername, $this->username,$this->password);
    // Check connection
    if (!$this->conn) {
        die("Connection failed: " .mysqli_connect_error());}
    else {
       //echo "Connected successfully";
        // echo "Error creating database: " .
        // mysqli_error($this->conn);
        }
}
function createDatabase($dbName){
    $sql = "CREATE DATABASE " . $dbName;  
    if (mysqli_query($this->conn, $sql)) {  
        echo "Database created successfully";  
    } else {  
        echo "Error creating database: " . mysqli_error($this->conn);  
    }  
    
}
function selectDatabase($dbName){
    //select database with the conn of the class, using mysqli_select..
    mysqli_select_db($this->conn,$dbName);
}

function createTable($query){
  //creating a table with the query
  if (mysqli_query($this->conn, $query)) {
        echo "Table created successfully";
    } else {
        echo "Error creating table: " . mysqli_error($this->conn);
    }
    
}

}

?>
