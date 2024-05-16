<?php
// cabeçalhos CORS
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Authorization");

// Supress output buffering to prevent errors/warnings affecting the JSON response
ob_start();

// Função para retornar a resposta JSON e finalizar o script
function send_json_response($data)
{
    ob_end_clean(); // Limpar buffer de saída
    echo json_encode($data);
    exit();
}

// Ler os dados de conexão do corpo da requisição
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $filePath = '../Conexao/conexao.json';
    $config = json_decode(file_get_contents($filePath), true);

    // Estabelecer variaveis de conexao do banco
    $servername = $config['servername'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        send_json_response([
            "success" => false,
            "message" => "Erro ao conectar ao banco de dados",
            "error" => $conn->connect_error
        ]);
    } else {
        send_json_response([
            "success" => true,
            "message" => "Connection already established",
            "s" => $conn
        ]);
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataConnection = json_decode(file_get_contents('php://input'), true);

    // Caminho do arquivo JSON de conexão
    $filePath = "./conexao.json";

    // Salvar os dados de conexão no arquivo JSON
    file_put_contents($filePath, json_encode($dataConnection));

    $config = json_decode(file_get_contents($filePath), true);

    // Estabelecer variaveis de conexao do banco
    $servername = $config['servername'];
    $username = $config['username'];
    $password = $config['password'];
    $dbname = $config['dbname'];

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        send_json_response([
            "success" => false,
            "message" => "Erro ao conectar ao banco de dados",
            "error" => $conn->connect_error
        ]);
    } else {
        send_json_response(["success" => true, "message" => "successfully connected"]);
    }
} else {
    send_json_response([
        "error" => "Erro when manipulating data"
    ]);
}
