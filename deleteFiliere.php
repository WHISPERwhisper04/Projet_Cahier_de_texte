<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Récupérer l'ID du module à partir de l'URL
    if (isset($_GET['id_filiere'])) {
        $id = $_GET['id_filiere'];
        
        // Inclusion du fichier de connexion à la base de données
        include('connection.php');
        
        // Créer une instance de la classe Connection
        $connection = new Connection();
        
        // Sélectionner la base de données
        $connection->selectDatabase("cahierDeTexte");
        
        // Inclusion du fichier de la classe Module
        include('filiere.php');
        
        // Appeler la méthode statique pour supprimer le module
        Filiere::deleteFiliere('filiere', $connection->conn, $id);
    } else {
        // Si l'ID est manquant dans l'URL, afficher un message d'erreur
        echo "Filiere ID is missing!";
    }
}

?>
