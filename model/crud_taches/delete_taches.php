<?php
// Connexion à la base de données
require_once '../../db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/authCon.php');
    exit();
}

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['idTache'];

        // Préparation de la requête de suppression
        $stmt = $pdo->prepare("DELETE FROM taches WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':user_id', $_SESSION['user_id']);

        // Exécution de la requête
        $stmt->execute();
    }
    header('Location: ../todos.php');
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression de tâches</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>
    <nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="../../authentification/authCon.php">Retour</a></button>
            <button><a href="logout.php">Déconnexion</a></button>
        </div>

    </nav>


</body>

</html>