<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../../authentification/connexion.php');
    exit();
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Je nettoie les données du formulaire
    $_POST = filter_input_array(INPUT_POST, [
        'titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'action' => FILTER_VALIDATE_BOOLEAN,
        'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);


    $titre = $_POST['titre'];
    $action = isset($_POST['action']) ? 1 : 0;
    $date = $_POST['date'];

    // Validation des champs
    if($titre && $date){
    $stmt = $pdo->prepare("INSERT INTO taches (user_id, titre, date, action) VALUES (?, ?, ?, ?)");
    if($stmt->execute([$userId, $titre, $date, $action])){
        header('Location: ../../view/todos.php');
        exit();
    }else{
        $error = "Erreur lors de la création de la tâche.";
    }
}else{
    $error = "Veuillez remplir tous les champs";
}  
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
        <a href="../../index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="../../authentification/authCon.php">Retour</a></button>
            <button><a href="logout.php">Se déconnecter</a></button>
        </div>

    </nav>

    <div class="form-container">
        <h2>Créer une tâche</h2>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
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