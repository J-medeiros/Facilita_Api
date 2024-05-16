<?php
// cabeçalhos CORS
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization");

// Permitir solicitações de qualquer origem
header("Access-Control-Allow-Origin: *");
// Outros cabeçalhos CORS necessários
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Ler os dados de conexão do corpo da requisição
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filePath = '../Conexao/conexao.json';
    $config = json_decode(file_get_contents($filePath), true);
    // Estabelecer variaveis de conexao do banco
    $servername = $config['servername'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];

    $conn  = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode([
            "success" => false,
            "message" => "Erro ao conectar ao banco de dados",
            "error" => $conn->connect_error
        ]);
    } else {
        echo json_encode([
            "success" => true,
            "message" => "Connection already established",
            "s" => $conn
        ]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataConnection = json_decode(file_get_contents('php://input'), true);

    // Verificar se a chave 'password' está definida
    $password = isset($dataConnection['password']) ? $dataConnection['password'] : ' ';

    // Caminho do arquivo JSON de conexão
    $filePath = "./conexao.json";

    // Salvar os dados de conexão no arquivo JSON
    file_put_contents($filePath, json_encode($dataConnection));
    //  data variable to connection
    $config = json_decode(file_get_contents($filePath), true);
    // Estabelecer variaveis de conexao do banco
    $servername = $config['servername'];
    $username = $config['username'];
    $dbname = $config['dbname'];

    $conn  = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode([
            "success" => false,
            "message" => "Erro ao conectar ao banco de dados",
            "error" => $conn->connect_error
        ]);
    } else {
        echo json_encode(["Sucess" => true, "Message" => "successfully connected "]);
    }
} else {
    echo json_encode([
        "Erro" => "Erro when manipulating data"
    ]);
}

function conect($config)
{
    // Função de conexão (se necessária)
}
