<?php
$db_host = 'sql307.infinityfree.com';
//$port = 3306;
$db_name = 'if0_36298690_CBD';
$db_user = 'if0_36298690';
$db_password = 'j50iKiio1N';

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Erro de conexão: ' . $e->getMessage();
    exit;
}

function registerUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password); // Armazenar a senha sem criptografia
    $stmt->execute();
}

function loginUser($username, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password); // Verificar a senha sem criptografia
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    } else {
        return false;
    }
}

function sendMessage($user_id, $message) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (:user_id, :message)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
}

function getMessages() {
    global $conn;
    $stmt = $conn->query("SELECT messages.message, users.username, messages.created_at FROM messages INNER JOIN users ON messages.user_id = users.id ORDER BY messages.created_at");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>