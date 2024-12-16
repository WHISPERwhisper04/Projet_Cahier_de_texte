<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des filieres</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>Liste des filieres</h2>
    <a class="btn btn-primary" href="addFiliere.php" role="button">Ajouter une filiere</a>
    <br><br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom du filiere</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Inclure le fichier de connexion
        include_once('connection.php');
        
        // Créer une instance de la classe Connection
        $connection = new Connection();
        
        // Appeler la méthode selectDatabase pour sélectionner la base de données
        $connection->selectDatabase('cahierDeTexte');
        
        // Inclure le fichier Module
        include('filiere.php');
        
        // Appeler la méthode statique pour récupérer tous les modules
        $filieres = Filiere::selectAllFiliere('filiere', $connection->conn);
        
        // Afficher chaque module dans un tableau
        foreach ($filieres as $row) {
            echo "
            <tr>
                <td>{$row['id_filiere']}</td>
                <td>{$row['nom']}</td>
                <td>{$row['description']}</td>
                <td>
                    <a class='btn btn-success btn-sm' href='updateFiliere.php?id_filiere={$row['id_filiere']}'>Modifier</a>
                    <a class='btn btn-danger btn-sm' href='deleteFiliere.php?id_filiere={$row['id_filiere']}'>Supprimer</a>
                </td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

</body>
</html>
