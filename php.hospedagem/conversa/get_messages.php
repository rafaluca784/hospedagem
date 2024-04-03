<?php
require_once 'db_connection.php';

// Obtém as mensagens do banco de dados
$messages = getMessages();

// Retorna as mensagens em formato JSON
header('Content-Type: application/json');
echo json_encode($messages);
?>
