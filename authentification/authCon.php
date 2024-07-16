<?php
// Import des ressources
require_once '../db_connexion.php';
session_start();

// Traitement du formulaire de connexion
if (isset($_POST['login'])) {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }



    if ($user && password_verify($password, $user['password'])) {

        $_SESSION['user_id'] = $user['id'];
        header('Location: ../model/todos.php');
        exit();
        var_dump($user);
    } else {
        $error = "Identifiants incorrects";
    }
} else {
    $error = "Veuillez remplir tous les champs";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion </title>
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <div class="form-container">
        <h1>Connexion</h1>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="login">Se connecter</button>
        </form>

    </div>

</body>

</html>