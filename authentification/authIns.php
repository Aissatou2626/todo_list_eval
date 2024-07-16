<?php
// Import des ressources
require_once '../db_connexion.php';

// Traitement du formulaire d'inscription
if (isset($_POST['inscrire'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (nom, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$nom, $email, $password]);
    header('Location: /authentification/authCon.php');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../styles/authIns.css">
    <link rel="stylesheet" href="../styles/navbar.css">
</head>

<body>


    <nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="authentification/authIns.php">S'incrire</a></button>
            <button><a href="authentification/authCon.php">Se connecter</a></button>
            <button><a href="logout.php">Déconnexion</a></button>
        </div>

    </nav>

    <div class="form-container">
        <h1>Inscription</h1>
        <form action="" method="post">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="inscrire">S'inscrire</button>
        </form>
    </div>

</body>

</html>