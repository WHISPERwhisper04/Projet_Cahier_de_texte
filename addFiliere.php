<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une filiere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>Ajouter une filiere</h2>
    <form action="addFiliere.php" method="POST">
        <div class="mb-3">
            <label for="nom_filiere" class="form-label">Nom du filiere</label>
            <input type="text" class="form-control" id="nom_filiere" name="nom_filiere" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Ajouter</button>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom_filiere = $_POST['nom_filiere'];
    $description = $_POST['description'];
    include('connection.php');
    include('filiere.php');
    // Créer une instance de la classe Module
    $filiere = new Filiere($nom_filiere, $description);

    // Ajouter le module dans la base de données
    $connection = new Connection();
    $connection->selectDatabase('cahierDeTexte');
    $filiere->insertFiliere('filiere', $connection->conn);
    
    if (Filiere::$successMsg) {
        echo "<div class='alert alert-success' role='alert'>" . Filiere::$successMsg . "</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . Filiere::$errorMsg . "</div>";
    }
}
?>

</body>
</html>
