<?php
// Import des ressources
require_once 'db_connexion.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /index.php');
    exit();
}

//Initialisation de la PDO pour se connecter à la BDD
$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
$listeTaches = [];
$requete = 'SELECT * FROM taches WHERE user_id = id ORDER BY date DESC LIMIT 5';
var_dump($requete);

// $stmt = $pdo->prepare("SELECT * FROM taches WHERE user_id = ? ORDER BY created_at DESC LIMIT 5");
$stmt = $pdo->query($requete);
$listeTaches = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>
  
    <h2>Vos 5 dernieres tâches</h2>

          
    <!-- Afficher vos 5 derrnières tâches-->
    <table>
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
    </ul>
    <a href="/model/todos.php">Ajouter tâches</a>
</body>
</html>
