<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION['user_id'])) {
    header('Location: ../authentification/connexion.php');
    exit();
}
// S'il est connecté , il peut alors mofifier ses données 
$userId = $_SESSION['user_id'];

//Gestion des requêtes POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Je récupère les valeurs du formulaire 
    if (isset($_POST['update'])) {
        $idUser = $_POST['idUser'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $password_hasher = password_hash($password, PASSWORD_BCRYPT);

        //Préparation de la requête de mise à jour
        $stmt = $pdo->prepare("UPDATE users SET nom = :nom, email = :email, password = :password WHERE id = :idUser");

        // Je remplace les paramètres par leurs valeurs 
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password_hasher);
        $stmt->bindParam(':idUser', $idUser);

        // J'exécute la requête
        if($stmt->execute()){
            echo "Modification réussie !";
        }else{
            echo "Erreur lors de la modification. ";
        }
        header('Location: ../authentification/connexion.php');
    }
   
}
//Récupération des données de l'utilisateur pour dans le formulaire
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :userId");
$stmt->bindParam(':userId', $userId);
$stmt->execute();
$users = $stmt->fetchAll(); 

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification de données de l'utilisateur</title>
    <link rel="stylesheet" href="../../styles/authIns.css">
    <link rel="stylesheet" href="../../styles/navbar.css">
</head>

<body>
    
    <h2>Modification de données de l'utilisateur</h2>

    <ul class="form-container">
        <?php foreach ($users as $user) : ?>
            <form action="" method="post">
                <input type="hidden" name="idUser" id="idUser" value="<?= $user['id'] ?>">
                <label for="nom">NOM :</label>
                <input type="text" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" required>
                <label for="email">EMAIL :</label>
                <input type="email" name="email" value="<?php echo $user['email']; ?>" required></br>
                <label for="password">PASSWORD :</label>
                <input type="password" name="password" value="<?php if ($user['password']) echo 'password'; ?>">
                <button type="submit" name="update">Modifier</button>
            </form>
        <?php endforeach ?>
    </ul>
    </form>

</body>

</html>