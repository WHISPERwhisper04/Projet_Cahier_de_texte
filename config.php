<?php
$emailErrorMsg = "";
$passwordErrorMsg = "";

if (isset($_POST["submit"])) {
    $emailValue = $_POST["email"];
    $passwordValue = $_POST["password"];

    // Validation email et mot de passe
    if ($emailValue == "") {
        $emailErrorMsg = "Email must be filled out";
    } else if (preg_match("/\w+(@emsi.ma){1}$/", $emailValue) == 0) {
        $emailErrorMsg = "Please enter a valid EMSI email";
    } else if ($passwordValue == "") {
        $passwordErrorMsg = "Password must be filled out";
    } else {
        // Inclure la connexion à la base de données
        include('connection.php');
        $connection = new Connection();
        $connection->selectDatabase('cahierDeTexte');
        
        // Préparer la requête pour éviter l'injection SQL
        $query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_prepare($connection->conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $emailValue); // Lier l'email
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            die("Erreur d'exécution de la requête : " . mysqli_error($connection->conn));
        }

        // Vérifier si l'utilisateur est trouvé
        if (mysqli_num_rows($result) == 1) {
            // Récupérer les détails de l'utilisateur
            $user = mysqli_fetch_assoc($result);

            // Vérifier le mot de passe
            if (password_verify($passwordValue, $user['password'])) {
                // Démarrer la session et stocker les informations de l'utilisateur
                session_start();
                $_SESSION["emailS"] = $emailValue;
                $_SESSION["roleS"] = $user['role']; // Stocker le rôle dans la session

                // Redirection en fonction du rôle de l'utilisateur
                if ($user['role'] == 'administrateur') {
                    header("Location: admin_dashboard.php");
                    exit();
                } else if ($user['role'] == 'professeur') {
                    header("Location: prof_dashboard.php");
                    exit();
                } else {
                    $emailErrorMsg = "Rôle d'utilisateur invalide.";
                }
            } else {
                $emailErrorMsg = "Email ou mot de passe incorrect.";
            }
        } else {
            $emailErrorMsg = "Email ou mot de passe incorrect.";
        }
    }
}
?>
