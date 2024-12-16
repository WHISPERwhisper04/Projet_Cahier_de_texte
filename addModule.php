<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Module</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container my-5">
    <h2>Ajouter un Module</h2>
    <form action="addModule.php" method="POST">
        <div class="mb-3">
            <label for="nom_module" class="form-label">Nom du Module</label>
            <input type="text" class="form-control" id="nom_module" name="nom_module" required>
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
    $nom_module = $_POST['nom_module'];
    $description = $_POST['description'];
    include('connection.php');
    include('module.php');
    // Créer une instance de la classe Module
    $module = new Module($nom_module, $description);

    // Ajouter le module dans la base de données
    $connection = new Connection();
    $connection->selectDatabase('cahierDeTexte');
    $module->insertModule('module', $connection->conn);
    
    if (Module::$successMsg) {
        echo "<div class='alert alert-success' role='alert'>" . Module::$successMsg . "</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>" . Module::$errorMsg . "</div>";
    }
}
?>

</body>
</html>
