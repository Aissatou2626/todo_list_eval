<?php
    // Connexion à la base de données
    require_once '../../db_connexion.php';
    session_start();

    // Vérification de la session utilisateur
    if (!isset($_SESSION['user_id'])) {
        header('Location: ../authentification/authCon.php');
        exit();
}

    $userId = $_SESSION['user_id'];

    // Initialisation de la PDO pour se connecter à la BDD
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['create'])) {
            $titre = $_POST['titre'];
            $action = isset($_POST['action']) ? 1 : 0;
            $date = $_POST['date'];
            
    
            $stmt = $pdo->prepare("INSERT INTO taches (user_id, titre, date, action) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $titre, $date, $action]);
        }
        header('Location: /model/todos.php');
    }


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creation des tâches</title>
    <link rel="stylesheet" href="../../styles/authIns.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>

 
    <nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="../../authentification/authCon.php">Retour</a></button>
            <button><a href="logout.php">Se déconnecter</a></button>
        </div>

    </nav>

    <div class="form-container">
        <h2>Créer une tâche</h2>
        <form method="POST" action="">
            <input type="text" name="titre" placeholder="Titre" required>
            <label for="action">Action :</label>
            <input type="checkbox" name="action">
            <input type="date" name="date">
            <button type="submit" name="create">Créer</button>
        </form>
    </div>
</body>

</html>