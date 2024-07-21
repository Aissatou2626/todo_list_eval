<?php
// Import des ressources
require_once 'db_connexion.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit();
}

//Initialisation de la PDO pour se connecter à la BDD
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCUEIL</title>

    <link rel="stylesheet" href="/styles/navbar.css">
    <link rel="stylesheet" href="/styles/accueil.css">
</head>
<body>
    
    <nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="authentification/authIns.php">S'incrire</a></button>
            <button><a href="authentification/authCon.php">Se connecter</a></button>
        </div>
    </nav>
    <div class="bouton_insc_con">
        <button><a href="/authentification/authIns.php">S'incrire</a></button>
        <button><a href="/authentification/authCon.php">Se connecter</a></button>
    </div>
</body>
</html>
