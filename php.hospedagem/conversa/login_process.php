<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica a senha no banco de dados
    $user = loginUser($username, $password);
    if ($user) {
        // Define um cookie com o ID do usuário
        setcookie("user_id", $user['id'], time() + 3600, "/"); // Válido por 1 hora
        header("Location: conversa.php");
        exit();
    } else {
        echo "Nome de usuário ou senha incorretos.";
    }
}
?>

