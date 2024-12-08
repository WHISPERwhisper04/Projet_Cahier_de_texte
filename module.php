<?php
class Module {
    public $id_module;
    public $nom_module;
    public $description;
    public static $errorMsg = "";
    public static $successMsg = "";
    public function __construct($nom_module, $description) {
        $this->nom_module = $nom_module;
        $this->description = $description;
    }
    public function insertModule($tableName,$conn){
        //insert a client in the database, and give a message to $successMsg and $errorMsg
        $sql = "INSERT INTO $tableName (nom_module, description)   
            VALUES ('$this->nom_module', '$this->description')";
            if (mysqli_query($conn, $sql)) {
                self::$successMsg="New record created successfully";
            } else {
                self::$errorMsg= "Error: " . $sql . "<br>" .mysqli_error($conn);
                } 
        }
    public static function selectAllModules($tableName, $conn) {
         include("database.php");
        $sql = "SELECT id_module, nom_module, description FROM $tableName";
        $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
            $data = [];
            while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
            }
            return $data;
            } 
        }
        static function selectModuleById($tableName,$conn,$id){
            //select a client by id, and return the row result
            $sql = "SELECT id_module, nom_module, description FROM $tableName WHERE id_module='$id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
            }
            return $row;
                
        }
    static function updateModule($module, $tableName, $conn, $id) {
        $sql = "UPDATE $tableName 
        SET nom_module = '$module->nom_module', description = '$module->description' 
        WHERE id_module = '$id'";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "Record updated successfully"; 
            header("Location: readModule.php");  
        } else {
            self::$errorMsg = "Error: " . mysqli_error($conn);
        }
    }
public static function deleteModule($tableName, $conn, $id) {
    $sql = "DELETE FROM $tableName WHERE id_module = '$id'";
    if (mysqli_query($conn, $sql)) {
    self::$successMsg = "Record deleted successfully"; 
    header("Location: readModule.php");
    } else {
        self::$errorMsg = "Error deleting record: " . mysqli_error($conn); 
    }
}
}
?>
