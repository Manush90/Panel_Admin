<?php
require_once 'Database.php';
require_once 'User.php';

session_start();

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {

    $user = new User($db);
    if ($user->authenticate($_POST['username'], $_POST['password'])) {
        $_SESSION['username'] = $_POST['username'];
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php');
        exit();
    }
} else {
    header('Location: login.php');
    exit();
}
