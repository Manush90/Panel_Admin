<?php
require_once 'Database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $db = new Database();

    $username = $_POST['username'];
    $query_check_user = "SELECT * FROM users WHERE users = :username";
    $params_check_user = array(':username' => $username);
    $result_check_user = $db->executeQuery($query_check_user, $params_check_user);

    if ($result_check_user === false) {
        echo "Si è verificato un errore durante il controllo dell'username nel database.";
        exit();
    }

    if (count($result_check_user) > 0) {
        echo "Username già in uso. Scegli un altro username.";
        exit();
    } else {
        $query_insert_user = "INSERT INTO users (users) VALUES (:username)";
        $params_insert_user = array(':username' => $username);
        $result_insert_user = $db->executeQuery($query_insert_user, $params_insert_user);

        if ($result_insert_user === false) {
            echo "Si è verificato un errore durante l'inserimento nel database. Dettagli: " . $db->getLastError();
            exit();
        } else {
            echo "Registrazione completata con successo. Ora puoi effettuare il login.";
            exit();
        }
    }
} else {
    header('Location: registrazione.php');
    exit();
}
