<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Registra o usuário no banco de dados
    registerUser($username, $password);

    // Redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

