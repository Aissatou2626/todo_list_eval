<?php
// Import des ressources
require_once '../services/db_connexion.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
// Récupération du nom de l'utilisateur
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT nom FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérification si l'utilisateur existe dans la BDD
if ($user) {
    $nom = htmlspecialchars($user['nom']);
} else {
    // Si l'utilisateur n'existe pas, on le déconnecte par sécurité
    session_destroy();
    unset($userId);

    header('Location: ../index.php');
    exit();
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ACCUEIL</title>

    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/accueil.css">
</head>

<body>


    <nav>
        <a href="./page_d_accueil.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="./crud_users/update_users.php">Modifier votre profil</a></button>
            <button><a href="./crud_users/delete_users.php">Supprimer le compte</a></button>
            <button><a href="./authentification/logout.php">Se déconnecter</a></button>
        </div>
    </nav>
    <h1>Welcome <?= $nom; ?></h1>


    <div class="bouton_insc_con">
        <button><a href="./crud_taches/update_taches.php">Modifier le profil</a></button>
        <button><a href="./crud_users/delete_users.php">Supprimer le compte</a></button>
        <button><a href="./authentification/logout.php">Se déconnecter</a></button>
        <button><a href="./todos.php">Mes tâches</a></button>
    </div>
</body>

</html>