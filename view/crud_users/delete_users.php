<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/connexion.php');
    exit();
}
$userId = $_SESSION['user_id'];

// Suppression de compte
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['delete'])) {
        

        // Préparation de la requête de suppression
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    

        // Exécution de la requête
        $stmt->execute();
    }
    header('Location: ../authentification/logout.php');
}
?>
