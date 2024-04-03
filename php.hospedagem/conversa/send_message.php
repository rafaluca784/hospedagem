<?php
require_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
        $message = $_POST['message'];

        // Insere a mensagem no banco de dados
        sendMessage($user_id, $message);

        echo "Mensagem enviada com sucesso!";
    } else {
        http_response_code(401); // Não autorizado
        echo "Erro: Usuário não autenticado.";
    }
} else {
    http_response_code(405); // Método não permitido
    echo "Erro: Método de requisição inválido.";
}
?>
