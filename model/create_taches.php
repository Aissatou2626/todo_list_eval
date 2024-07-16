<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/navbar.css">
</head>

<body>

<nav>
        <a href="index.php" class="logo"><img src="/images/logo_todolist.jpg" alt="logo_todolist"></a>
        <div class="button-container">
            <button><a href="authentification/authIns.php">S'incrire</a></button>
            <button><a href="authentification/authCon.php">Se connecter</a></button>
            <button><a href="logout.php">Déconnexion</a></button>
        </div>

    </nav>

    <div class="form-container">
        <h2>Créer une tâche</h2>
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