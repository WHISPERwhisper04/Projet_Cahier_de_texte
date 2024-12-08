<?php
// Démarrer la session pour récupérer les variables de session
session_start();

// Vérifier si l'utilisateur est authentifié et a le rôle d'administrateur
if (!isset($_SESSION['emailS']) || $_SESSION['roleS'] != 'administrateur') {
    header("Location: login.php"); // Rediriger vers la page de connexion si non autorisé
    exit();
}

// Créer une instance de la connexion à la base de données
include_once("connection.php");
$connection = new Connection();
$connection->selectDatabase('cahierDeTexte');

// Récupérer les informations de l'admin connecté
$admin_email = $_SESSION['emailS'];
$admin_info = mysqli_fetch_assoc(mysqli_query($connection->conn, "SELECT * FROM user WHERE email = '$admin_email'"));
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Styles de base pour la page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* Barre de navigation à gauche */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #2c3e50;
            
            color: white;
            padding-top: 40px;
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            padding: 15px;
            color: white;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #16a085;
        }

        /* Content area */
        .content {
            margin-left: 270px;
            padding: 30px;
        }

        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px 0;
            text-align: center;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">Admin Panel</h3>
        <a href="admin_dashboard.php">Mon Profil</a>
        <a href="read.php">Gestion des Utilisateurs</a>
        <a href="readModule.php">Gestion des Modules</a>
        <a href="#">Gestion des Groupes</a>
        <a href="#">Gestion des Filières</a>
        <a href="logout.php">Déconnexion</a>
    </div>

    <!-- Main Content Area -->
    <div class="content">
        <div class="header">
            <h1>Tableau de Bord Administrateur</h1>
        </div>
        <br>
        <br>
        <div>
            <h2>Bienvenue, <?= htmlspecialchars($admin_info['firstname']) ?> <?= htmlspecialchars($admin_info['lastname']) ?>!</h2>
            <p>Ceci est votre tableau de bord où vous pouvez gérer les utilisateurs, modules, groupes, et plus encore.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
