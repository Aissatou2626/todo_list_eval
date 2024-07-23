<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';
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
    <title>TODO List</title>
    <link rel="stylesheet" href="../../styles/main.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
    <link rel="stylesheet" href="../../styles/btn_crud.css">
</head>

<body>
    <!--navbar-->

    <nav>
        <a href="page_d_accueil.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="authentification/authCon.php">Retour</a></button>
            <button><a href="logout.php">Déconnexion</a></button>
        </div>

    </nav>

    <div class="button_crud">
        <button><a href="crud_taches/create_taches.php">+ Ajouter une tâche</a></button>
        <button><a href="crud_taches/update_taches.php">Modifier une tâche</a></button>

    </div>

    <h2>Vos 5 dernières tâches</h2>
    <table class="form-container">
        <tr>
            <th>Id</th>
            <th>User_id</th>
            <th>Titre</th>
            <th>Action</th>
            <th>Date</th>
            <th>Date de modification</th>
            <th>Suppression</th>
        </tr>
        <?php
        // Afficher les données de la todo list et bouton pour suppression de tâches
        foreach ($listeTaches as $tache) {
            echo '<tr>';
            foreach ($tache as $key => $valeur) {
                echo '<td>' . htmlentities($valeur, ENT_QUOTES) . '</td>';
            }
            echo '<td>
            <form method="POST" action="crud_taches/delete_taches.php">
                <input type="hidden" name="idTache" value="' . $tache['id'] .'">
                <button type="submit" name="delete">Supprimer</button>
            </form>
          </td>';
            echo '</tr>';
        }
        ?>


    </table>
</body>

</html>