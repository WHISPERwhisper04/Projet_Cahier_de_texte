<?php
class Filiere {
    public $id_filiere;
    public $nom;
    public $description;
    public static $errorMsg = "";
    public static $successMsg = "";
    public function __construct($nom, $description) {
        $this->nom = $nom;
        $this->description = $description;
    }

    public function insertFiliere($tableName, $conn) {
        // Insérer une nouvelle filière dans la base de données
        $sql = "INSERT INTO $tableName (nom, description) VALUES ('$this->nom', '$this->description')";
        
        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "New record created successfully";
        } else {
            self::$errorMsg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public static function selectAllFiliere($tableName, $conn) {
        // Sélectionner toutes les filières de la base de données
        $sql = "SELECT id_filiere, nom, description FROM $tableName";
        $result = mysqli_query($conn, $sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public static function selectFiliereById($tableName, $conn, $id) {
        // Sélectionner une filière par ID
        $sql = "SELECT nom, description FROM $tableName WHERE id_filiere = '$id'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
    }

    public static function updateFiliere($filiere, $tableName, $conn, $id) {
        // Mettre à jour une filière par ID
        $sql = "UPDATE $tableName SET nom = '$filiere->nom', description = '$filiere->description' WHERE id_filiere = '$id'";
        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "Record updated successfully";
            header("Location: readFiliere.php");
        } else {
            self::$errorMsg = "Error: " . mysqli_error($conn);
        }
    }

    public static function deleteFiliere($tableName, $conn, $id) {
        // Supprimer une filière par ID
        $sql = "DELETE FROM $tableName WHERE id_filiere = '$id'";
        
        if (mysqli_query($conn, $sql)) {
            self::$successMsg = "Record deleted successfully";
            header("Location: readFiliere.php");
        } else {
            self::$errorMsg = "Error deleting record: " . mysqli_error($conn);
        }
    }
}
?>
