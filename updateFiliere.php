<?php

$nomFiliereValue = "";
$descriptionValue = "";
$errorMessage = "";
$successMessage = "";

// Inclusion des fichiers nécessaires
include_once('connection.php');  // Connexion à la base de données
include_once('filiere.php');      // Inclusion de la classe Module

// Création de l'objet de connexion
$connection = new Connection();
$connection->selectDatabase('cahierDeTexte');

// Vérification si l'ID du module est passé dans l'URL (GET)
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id_filiere'])) {
        $id = $_GET['id_filiere'];
        // Récupérer le module par son ID
        $filiere = Filiere::selectFiliereById('filiere', $connection->conn, $id);
        if ($filiere) {
            $nomFiliereValue = $filiere['nom'];
            $descriptionValue = $filiere['description'];
        } else {
            $errorMessage = "Filiere not found!";
        }
    } else {
        $errorMessage = "Filiere ID is missing!";
    }
}

// Si le formulaire est soumis (POST)
else if (isset($_POST["submit"])) {
    // Récupérer les valeurs du formulaire
    $nomFiliereValue = $_POST["nom_filiere"];
    $descriptionValue = $_POST["description"];

    // Vérification des champs obligatoires
    if (empty($nomFiliereValue) || empty($descriptionValue)) {
        $errorMessage = "All fields must be filled out!";
    } else {
        // Créer une nouvelle instance de Module
        $filiere = new Filiere($nomFiliereValue, $descriptionValue);
        // Appeler la méthode pour mettre à jour le module
        Filiere::updateFiliere($filiere, 'filiere', $connection->conn, $_GET['id_filiere']);
        $successMessage = "Filiere updated successfully!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Filiere</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">

        <h2>Update Filiere</h2>

        <!-- Affichage des messages d'erreur -->
        <?php
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

        // Affichage des messages de succès
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <br>
        <!-- Formulaire de mise à jour du module -->
        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="nom_filiere">Filiere Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $nomFiliereValue ?>" class="form-control" type="text" id="nom_filiere" name="nom_filiere">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="description">Description:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $descriptionValue ?>" class="form-control" type="text" id="description" name="description">
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-2 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="readFiliere.php">Cancel</a>
                </div>
            </div>
        </form>

    </div>

</body>
</html>
