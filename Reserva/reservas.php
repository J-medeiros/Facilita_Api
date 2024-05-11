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

    $sql = "SELECT id, nome_hospede, email, cpf, id_quarto, checkin, checkout  FROM reserva ";

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
} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $checkin = isset($_GET['checkin']) && !empty($_GET['checkin']) ? $_GET['checkin'] : null;
    $checkout = isset($_GET['checkout']) && !empty($_GET['checkout']) ? $_GET['checkout'] : null;

    $checkout = date('Y-m-d');
    $checkin = date('Y-m-d');

    $sql = "INSERT INTO reserva (nome_hospede, email, cpf, id_quarto, checkin, checkout) VALUES
    ( '{$data['nome_hospede']}', '{$data['email']}','{$data['cpf']}', {$data['id_quarto']}, '$checkin', '$checkout' );";

    if ($conn->query($sql) === TRUE) {
        $message = "Inserido com sucesso!!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = isset($_GET['id']) && !empty($_GET['id']) ? $_GET['id'] : null;
    $data = json_decode(file_get_contents('php://input'), true);

    $query = "UPDATE reserva SET";
    $comma = " ";
    foreach ($data as $key => $val) {
        if (!empty($val)) {
            $query .= $comma . $key . "= '" . mysqli_real_escape_string($conn, trim($val)) . "' ";
            $comma = ", ";
        }
    }
    $query .= "WHERE id = $id";
    // Execute a consulta no banco de dados (use a conexão $conn adequada)
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Operação bem-sucedida
        echo json_encode(array('message' => 'Atualização bem-sucedida.'));
    } else {
        // Erro na consulta
        echo json_encode(array('error' => 'Erro na atualização.'));
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
} else {
    echo json_encode(["error" => "Consulta Inválida"]);
}
