<?php
require_once 'Database.php';

// Verifica se il modulo di registrazione è stato inviato
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    // Recupera l'username inviato dal modulo di registrazione
    $username = $_POST['username'];

    // Connettiti al database (sostituisci 'nome_utente', 'password' e 'panel_admin' con le tue credenziali)
    $database = new Database('localhost', 'nome_utente', 'password', 'panel_admin');

    // Controlla se l'utente esiste già nel database
    $query = "SELECT * FROM users WHERE username = :username";
    $existing_user = $database->query($query, array(':username' => $username));

    if (!$existing_user) {
        // Se l'utente non esiste, inseriscilo nel database
        $query = "INSERT INTO users (username) VALUES (:username)";
        $database->query($query, array(':username' => $username));

        // Reindirizza l'utente alla pagina di login dopo la registrazione
        header('Location: login.php');
        exit();
    } else {
        // Se l'utente esiste già, mostra un messaggio di errore
        $registration_error = "Errore: L'utente esiste già.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>

<body>
    <h2>Registrazione</h2>
    <?php if (isset($registration_error)) : ?>
        <p style="color: red;"><?php echo $registration_error; ?></p>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <input type="submit" name="register" value="Registrati">
    </form>
</body>

</html>
?>