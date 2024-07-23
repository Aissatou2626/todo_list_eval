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

//Gestion des requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Je récupère les valeurs du formulaire 
    if (isset($_POST['update'])) {
        $id = $_POST['idTache'];
        $titre = $_POST['titre'];
        $date = $_POST['date'];
        $action = isset($_POST['action']) ? 1 : 0;

        //To do: Les paramètres
        $stmt = $pdo->prepare("UPDATE taches SET titre = :titre, date = :date, action = :action WHERE id = :id ");
   
        // Je remplace les paramètres par leurs valeurs 
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':id', $id);
       
        // J'exécute la requête
        $stmt->execute();
        
        $nb = $stmt->rowCount();
    }
    header('Location: ../todos.php');
 

}

    $stmt = $pdo->prepare("SELECT id, titre, date, action FROM taches WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $userId);


    $stmt->execute();
    $taches = $stmt->fetchAll();

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de tâches</title>
    <link rel="stylesheet" href="../../styles/authIns.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>
    <nav>
        <a href="page_d_accueil.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
        
            <button><a href="./create_taches.php">Retour</a></button>
            <button><a href="../authentification/logout.php">Se déconnecter</a></button>
        </div>

    </nav>
    


    <ul  class="form-container">
        <?php foreach ($taches as $tache): ?> 
            <li>
                <form method="POST" action="">
                    <input type="hidden" name="idTache" id="idTache" value="<?= $tache['id']?>">
                    <label for="Titre tâche"></label>
                    <input type="text" name="titre" value="<?php echo htmlspecialchars($tache['titre']); ?>" required>
                    <input type="date" name="date" value="<?php echo $tache['date']; ?>" required>
                    <label for="action">Action :</label>
                    <input type="checkbox" name="action" <?php if ($tache['action']) echo 'checked'; ?>>
                    <button type="submit" name="update">Modifier</button>
                </form>

            </li>
        <?php endforeach; ?>
    </ul>

</body>

</html>