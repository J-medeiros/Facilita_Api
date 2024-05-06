<?php
//conexão ao banco de dados //
$filePath = './conexao.json';

$config = json_decode(file_get_contents($filePath), true);
// Estabelecer variaveis de conexao do banco
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$conn  = new mysqli($servername, $username, $password, $dbname);

echo json_encode(["conn" => $config]);

if ($conn->connect_error) {
    echo json_encode([
        "success" => false,
        "message" => "Erro ao conectar ao banco de dados",
        "error" => $conn->connect_error
    ]);
} else {
    //  echo json_encode([
    //  "success" => true,
    //  "message" => "Connection already established",
    //  ]);
    return $config;
}
?>