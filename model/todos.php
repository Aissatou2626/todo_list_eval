<?php
// Connexion à la base de données
require_once '../db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/authCon.php');
    exit();
}

$userId = $_SESSION['user_id'];

// Initialisation de la PDO pour se connecter à la BDD
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);

// Requête pour obtenir les 5 dernières tâches de l'utilisateur
$requete = 'SELECT * FROM taches WHERE user_id = :user_id ORDER BY updated_at DESC LIMIT 5';
$stmt = $pdo->prepare($requete);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$listeTaches = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($listeTaches);

// Si le $_POST est défini, traiter le formulaire de création de tâches
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Je nettoie les données du formulaire
    $_POST = filter_input_array(INPUT_POST, [
        'titre' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
        'action' => FILTER_VALIDATE_BOOLEAN,
        'date' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ]);

    // J'hydrate les variables pour remplacer les paramètres de la requête
    $titre = $_POST['titre'];
    $action = isset($_POST['action']) ? 1 : 0;
    $date = $_POST['date'];

    // J'écris ma requête paramétrée et nommée
    $requete = 'INSERT INTO taches (user_id, titre, date, action) VALUES (:user_id, :titre, :date, :action)';
    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':action', $action);
    $stmt->bindParam(':date', $date);
    $stmt->execute();

    // Rediriger pour rafraîchir la liste des tâches
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO List</title>
    <link rel="stylesheet" href="../styles/main.css">
</head>

<body>
    <div class="form-container">
        <h2>Créer une TODO</h2>
        <form method="POST" action="">
            <input type="text" name="titre" placeholder="Titre" required>
            <label for="action">Action :</label>
            <input type="checkbox" name="action">
            <input type="date" name="date">
            <button type="submit" name="create">Créer</button>
        </form>
    </div>

    <h2>Vos dernières tâches</h2>
    <table class="form-container">
        <tr>
            <th>Id</th>
            <th>User_id</th>
            <th>Titre</th>
            <th>Action</th>
            <th>Date</th>
            <th>Date de modification</th>
        </tr>
        <?php
      
       // Afficher les données  de la todo list
       for ($i=0; $i < 5 ; $i++) { 
        foreach ($listeTaches as $key => $tache){
            echo '<tr>';
            foreach($tache as $valeur){
                echo '<td>'. $valeur . '</td>';
            }
            echo '</tr>';
        }
    }
        ?>
    </table>
</body>

</html>