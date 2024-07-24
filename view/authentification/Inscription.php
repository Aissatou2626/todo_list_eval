<?php
// Import des ressources
require_once '../../services/db_connexion.php';

// Initialisation des variables pour les messages
$messageChamp = "";
$passwordError = "";

// Traitement du formulaire d'inscription
if (isset($_POST['inscrire'])) {
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    // Validation du mot de passe avec regex (au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial)
    $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    if (!$nom || !$email || !$password) {
        $messageChamp = "Veuillez remplir tous les champs.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $passwordError = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    } else {
        $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $pdo->prepare("INSERT INTO users (nom, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$nom, $email, $passwordHashed])) {
            header('Location: ./connexion.php');
            exit();
        } else {
            $messageChamp = "Une erreur est survenue lors de la création du compte.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="../../styles/authIns.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>
    <nav>
        <a href="../../index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="./connexion.php">Se connecter</a></button>
        </div>
    </nav>

    <div class="form-container">
        <h2>Inscription</h2>
        <!-- Affichage des messages d'erreur sur les champs manquant et la validation du mot de passe-->
        <?php if ($messageChamp): ?>
            <p><?php echo $messageChamp; ?></p>
        <?php endif; ?>
        <?php if ($passwordError): ?>
            <p><?php echo $passwordError; ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="text" name="nom" placeholder="Nom" required>
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit" name="inscrire">S'inscrire</button>
        </form>
    </div>
</body>

</html>
