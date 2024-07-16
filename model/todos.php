<?php
// Connexion à la base de données
require_once '../db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/authCon.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Initialisation de la PDO pour se connecter à la BDD
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);


// Requête pour obtenir les 5 dernières tâches de l'utilisateur
$requete = 'SELECT * FROM taches WHERE user_id = :user_id ORDER BY date DESC LIMIT 5';
$stmt = $pdo->prepare($requete);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$listeTaches = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Si le $_POST est défini, traiter le formulaire de création de tâches
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Je nettoie les données du formulaire
    $_POST = filter_input_array(INPUT_POST, [
        'titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'action' => FILTER_VALIDATE_BOOLEAN,
        'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    // J'hydrate les variables pour remplacer les paramètres de la requête
    $titre = $_POST['titre'];
    $action = isset($_POST['action']) ? 1 : 0;
    $date = $_POST['date'];

    // J'écris ma requête paramétrée et nommée
    $requete = 'INSERT INTO taches (user_id, titre, date, action) VALUES (:user_id, :titre, :date, :action)';
    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':action', $action);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    // Rediriger pour rafraîchir la liste des tâches
    header('Location: ../model/todos.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../styles/navbar.css">
</head>

<body>
    <!--navbar-->

    <nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="authentification/authIns.php">S'incrire</a></button>
            <button><a href="authentification/authCon.php">Se connecter</a></button>
            <button><a href="logout.php">Déconnexion</a></button>
        </div>

    </nav>
    <div class="button_crud">
        <button><a href="create_taches.php">Créer tâche</a></button>
        <button><a href="update_taches.php">Modifier tâche</a></button>
        <button><a href="delete_taches.php">Supprimer tâche</a></button>

    </div>

    <h2>Vos dernières tâches</h2>
    <table class="form-container">
        <tr>
            <th>Id</th>
            <th>User_id</th>
            <th>Titre</th>
            <th>Action</th>
            <th>Date</th>
            <th>Date de modification</th>
        </tr>
        <?php

        // Afficher les données  de la todo list

        foreach ($listeTaches as $key => $tache) {
            echo '<tr>';
            foreach ($tache as $valeur) {
                echo '<td>' . $valeur . '</td>';
            }
            echo '</tr>';
        }

        ?>
    </table>
</body>

</html>