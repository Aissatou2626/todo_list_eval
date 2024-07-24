<?php
// Import des ressources
require_once './services/db_connexion.php';

session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ./view/page_d_accueil.php');
    exit();
}


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
            <button><a href="./view/authentification/Inscription.php">S'incrire</a></button>
            <button><a href="./view/authentification/connexion.php">Se connecter</a></button>
        </div>
    </nav>

    <h1>Ma page d'accueil</h1>

    <div class="bouton_insc_con">
        <button><a href="./view/authentification/Inscription.php">S'incrire</a></button>
        <button><a href="./view/authentification/connexion.php">Se connecter</a></button>
    </div>
    
</body>
</html>
