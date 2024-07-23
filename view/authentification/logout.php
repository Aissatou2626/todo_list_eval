<?php
// Connexion à la base de données
require_once '../../services/db_connexion.php';

// Démarrage de la session
session_start();

// Destruction de toutes les variables de session
$_SESSION = array();

session_destroy();

// Redirection vers la page de connexion ou d'accueil
header('Location: ./connexion.php');
exit();

?>
