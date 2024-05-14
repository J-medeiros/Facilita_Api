<?php
//set_include_path('../Conexao/conexao.php');
define("BASE_PATH", dirname('../Conexao/conexao.php'));

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');
header("Access-Control-Allow-Headers: X-Requested-With");
// Permitir solicitações de qualquer origem
header("Access-Control-Allow-Origin: *");

// Outros cabeçalhos CORS necessários
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization");
//Variavel 
$Check_function;
// Estabelecer variaveis de conexao do banco
$filePath = '../Conexao/conexao.json';

$config = json_decode(file_get_contents($filePath), true);
$servername = $config['servername'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['dbname'];

$conn  = new mysqli($servername, $username, $password, $dbname);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : null;
    $id = isset($_GET['id']) ? $_GET['id'] : null;

    $sql = "SELECT id, nome, cidade, estado, complemento, informacao_hotel, image FROM reservahotel.hotel;";

    // Verifica qual parâmetro está presente e ajusta a condição WHERE
    if (!empty($filtro) && empty($id)) {
        $sql .= " WHERE nome LIKE ?";
        $stmt = $conn->prepare($sql);
        $filtro = "%$filtro%";
        $stmt->bind_param("s", $filtro);
    } else if (empty($filtro) && !empty($id)) {
        $sql .= " WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id); // Assumindo que o campo id é um número inteiro
    } else {
        // Caso ambos os parâmetros estejam vazios ou ambos presentes, trata conforme necessário
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    echo json_encode(
        ["data" => $result->fetch_all(MYSQLI_ASSOC), "totalCount" => $result->num_rows, "summary" => null, "groupCount" => null, 'success' => true]
    );

    $stmt->close();
    $conn->close();
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents('php://input'), true);

    $sql = "INSERT INTO aluno ( nome , cidade , estado , complemento , informacao_hotel ) 
                VALUES ( '{$data['nome']}', '{$data['cidade']}','{$data['estado']}', '{$data['complemento']}', '{$data['informacao_hotel']}' );";

    if ($conn->query($sql) === TRUE) {
        $message = "Inserido com sucesso!!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo json_encode(["error" => "Consulta Inválida"]);
}