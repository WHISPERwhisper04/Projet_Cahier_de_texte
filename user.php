<?php
class User{
public $id_user;
public $firstname;
public $lastname;
public $email;
public $phone;
public $password;
public $role;
public $reg_date; 
public static $errorMsg = "";
public static $successMsg="";
public function __construct($firstname,$lastname,$email,$phone,$password,$role){
    //initialize the attributs of the class with the parameters, and hash the password
    $this->firstname=$firstname;
    $this->lastname=$lastname;
    $this->email=$email;
    $this->phone=$phone;
    $this->role = $role;
    $this->password=password_hash($password,PASSWORD_DEFAULT);
}
public function insertUser($tableName,$conn){
//insert a client in the database, and give a message to $successMsg and $errorMsg
$sql = "INSERT INTO $tableName (firstname, lastname, email, phone, password, role)   
    VALUES ('$this->firstname', '$this->lastname', '$this->email', '$this->phone', '$this->password', '$this->role')";
    if (mysqli_query($conn, $sql)) {
        self::$successMsg="New record created successfully";
    } else {
        self::$errorMsg= "Error: " . $sql . "<br>" .mysqli_error($conn);
        } 

}

public static function  selectAllUsers($tableName,$conn){
//select all the client from database, and inset the rows results in an array $data[]
include("database.php");
    $sql = "SELECT id_user, firstname, lastname, email, phone, role FROM $tableName";  
    $result = mysqli_query($conn, $sql); 
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $data=[];
    while($row = mysqli_fetch_assoc($result)) {
        $data[]=$row;
    }
    return $data;
}
}

static function selectUserById($tableName,$conn,$id){
    //select a client by id, and return the row result
    $sql = "SELECT firstname, lastname, email, phone, role FROM $tableName WHERE id_user='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
        
}
static function updateUser($user,$tableName,$conn,$id){
    //update a client of $id, with the values of $client in parameter
    //and send the user to read.php
    $sql = "UPDATE $tableName SET firstname='$user->firstname', lastname='$user->lastname', email='$user->email', phone='$user->phone',role='$user->role' WHERE id_user='$id'";
    if (mysqli_query($conn, $sql)) {
        self::$successMsg = "Record updated successfully";
        header("Location: read.php");  
    } else {
        self::$errorMsg = "Error: " . mysqli_error($conn);
    }
}
static function deleteUser($tableName,$conn,$id){
    //delet a client by his id, and send the user to read.php
    $sql = "DELETE FROM $tableName WHERE id_user='$id'";
    if (mysqli_query($conn, $sql)) {
    self::$successMsg="Record deleted successfully";
    header("Location:read.php");
    } else {
    self::$errorMsg="Error deleting record: " .
    mysqli_error($conn);
    }
    }
}

?>
