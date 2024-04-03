<?php
// Conexão com o banco de dados MySQL
$db_host = 'sql307.infinityfree.com';
//$port = 3306;
$db_name = 'if0_36298690_CBD';
$db_user = 'if0_36298690';
$db_password = 'j50iKiio1N';

// Conexão com o banco de dados MySQL
$mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);

// Verifica se houve erro na conexão
if ($mysqli->connect_errno) {
    echo "Falha ao conectar ao MySQL: " . $mysqli->connect_error;
}

// Consulta para obter a versão do MySQL
$resultado = $mysqli->query("SELECT VERSION() AS versao");

// Verifica se a consulta foi bem-sucedida
if ($resultado) {
    $row = $resultado->fetch_assoc();
    echo "Versão do MySQL: " . $row['versao'];
} else {
    echo "Erro ao obter a versão do MySQL: " . $mysqli->error;
}

// Consulta para obter variáveis de configuração do MySQL
$resultado_variaveis = $mysqli->query("SHOW VARIABLES");

// Verifica se a consulta foi bem-sucedida
if ($resultado_variaveis) {
    // Loop através dos resultados
    while ($row = $resultado_variaveis->fetch_assoc()) {
        echo $row['Variable_name'] . ': ' . $row['Value'] . '<br>';
    }
} else {
    echo "Erro ao obter as variáveis de configuração do MySQL: " . $mysqli->error;
}

// Fecha a conexão com o banco de dados
$mysqli->close();
?>

