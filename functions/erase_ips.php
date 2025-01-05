<?php
// Conexão com o banco de dados
$host = 'sql100.infinityfree.com'; // Altere conforme necessário
$username = 'if0_37637077';
$password = 'uweOtri6Tte ';
$database = 'if0_37637077_bfmatchmakerdb';

$connection = new mysqli($host, $username, $password, $database);

// Verifique a conexão
if ($connection->connect_error) {
    die("Conexão falhou: " . $connection->connect_error);
}

// Defina o período (em dias) após o qual os IPs serão excluídos
$daysToKeep = 30;

// Executa o comando para excluir registros antigos
$sql = "DELETE FROM request_log WHERE access_date < NOW() - INTERVAL $daysToKeep DAY";
if ($connection->query($sql) === TRUE) {
    echo "Registros antigos foram excluídos com sucesso.";
} else {
    echo "Erro ao excluir registros: " . $connection->error;
}

// Feche a conexão
$connection->close();
?>
