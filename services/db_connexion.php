<?php
$host = 'localhost';
$db = 'todolist';
$user = 'admin'; 
$password = 'ad$$n2011'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>