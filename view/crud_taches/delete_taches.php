<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/connexion.php');
    exit();
}


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

