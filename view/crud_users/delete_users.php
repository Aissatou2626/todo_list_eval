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
    // On détruit la session et on le redirige vers la page d'accueil pour qu'il puisse s'inscrire s'il le souhaite
    session_destroy();
    // Suppression du coockie par défault
    unset($_COOKIE['PHPSESSID']);
   

    // Destruction de la clé 'user_id' de la variable super globale $_SESSION['user_id'] 
    unset($userId);
    header('Location: ../index.php');
    exit();
}
?>
