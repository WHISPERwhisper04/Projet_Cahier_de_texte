<?php

$emailValue = "";
$lnameValue = "";
$fnameValue = "";
$phoneValue = "";
$roleValue = "";
$errorMessage = "";
$successMessage = "";

//include connection file   
include_once('connection.php');

//create an instance of the Connection class
$connection = new Connection();

//call the selectDatabase method
$connection->selectDatabase('cahierDeTexte');

//include the user file
include('user.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Vérifier si l'ID est dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Call the static selectUserById method and store the result in $row
        $row = User::selectUserById('user', $connection->conn, $id);
        if ($row) {
            $emailValue = $row["email"];
            $lnameValue = $row["lastname"];
            $fnameValue = $row["firstname"];
            $phoneValue = $row["phone"];
            $roleValue = $row["role"];
        } else {
            $errorMessage = "User not found!";
        }
    } else {
        $errorMessage = "User ID is missing!";
    }

} else if (isset($_POST["submit"])) {

    // Récupérer les valeurs du formulaire
    $emailValue = $_POST["email"];
    $lnameValue = $_POST["lastName"];
    $fnameValue = $_POST["firstName"];
    $phoneValue = $_POST["phone"];
    $roleValue = $_POST["role"];

    // Vérification des champs obligatoires
    if (empty($emailValue) || empty($fnameValue) || empty($lnameValue) || empty($phoneValue) || empty($roleValue)) {
        $errorMessage = "All fields must be filled out!";
    } else {
        // Créer une nouvelle instance de User
        $user = new User($fnameValue, $lnameValue, $emailValue, $phoneValue, '', $roleValue);
        User::updateUser($user, 'user', $connection->conn, $_GET['id']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5 ">

        <h2>Update User</h2>

        <?php
        // Afficher les messages d'erreur
        if (!empty($errorMessage)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }

        // Afficher les messages de succès
        if (!empty($successMessage)) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
        }
        ?>

        <br>
        <form method="post">
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="fname">First Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $fnameValue ?>" class="form-control" type="text" id="fname" name="firstName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="lname">Last Name:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $lnameValue ?>" class="form-control" type="text" id="lname" name="lastName">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="email">Email:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $emailValue ?>" class="form-control" type="email" id="email" name="email">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="phone">Phone:</label>
                <div class="col-sm-6">
                    <input value="<?php echo $phoneValue ?>" class="form-control" type="text" id="phone" name="phone">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-form-label col-sm-2" for="role">Role:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="role" name="role">
                        <option value="administrateur" <?php if ($roleValue == 'administrateur') echo 'selected'; ?>>Administrateur</option>
                        <option value="professeur" <?php if ($roleValue == 'professeur') echo 'selected'; ?>>Professeur</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="offset-sm-2 col-sm-3 d-grid">
                    <button name="submit" type="submit" class="btn btn-primary">Update</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="read.php">Cancel</a>
                </div>
            </div>
        </form>

    </div>

</body>
</html>
