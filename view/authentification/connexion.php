<?php
// Ici, le READ du CRUD de la table users

// Import des ressources
require_once '../../services/db_connexion.php';
session_start();

// Traitement du formulaire de connexion et nettoyage des données recueillies
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST = filter_input_array(INPUT_POST, [
        'email' => FILTER_VALIDATE_EMAIL,
        'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Vérification des champs obligatoires
    if ($email && $password) {

        // Validation du mot de passe avec regex (au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial)
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        
        if (preg_match($passwordPattern, $password)) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($user && password_verify($password, $user['password'])) {
                echo "test";
                $_SESSION['user_id'] = $user['id'];
                header('Location: ../todos.php');
                exit();
            } else {
                $error = "Identifiants incorrects";
            }
        } else {
            $error = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion </title>

    <!--Mise en forme du formulaire de connexion-->
    <link rel="stylesheet" href="../../styles/authIns.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>

    <nav>
        <a href="../../index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="./Inscription.php">S'incrire</a></button>
            <button><a href="./connexion.php">Se connecter</a></button>

        </div>

    </nav>
    <div class="form-container">
        <h1>Connexion </h1>

        <?php if (isset($error)) : ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="post">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="login">Se connecter</button>
        </form>

    </div>

</body>

</html>