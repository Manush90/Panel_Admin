<?php
session_start();
require_once 'Database.php';
require_once 'User.php';

// Inizializza la connessione al database
$db = new Database();
$user = new User($db);

// Recupera tutti gli utenti dal database
$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>


<body>
    <h1>Pannello di amministrazione</h1>
    <?php

    if (isset($_SESSION['username'])) {
        echo "<p>Benvenuto, " . $_SESSION['username'] . "!</p>";

        unset($_SESSION['username']);
    }
    ?>
    <form action="index.php" method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>

    <div>
        <hr>
        <h3>Utenti Registrati</h3>
        <ul>
            <?php foreach ($users as $user) : ?>
                <li><?php echo $user['users']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <p>Non hai un account? <a href="registrazione.php">Registrati</a></p>
</body>

</html>