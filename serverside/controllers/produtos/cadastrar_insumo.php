<?php 

function formatToFloat($value) {
    // Remove "R$", espaços e substitui a vírgula por ponto
    $formattedValue = str_replace(['R$', ' ', ''], '', $value);
    $formattedValue = str_replace(',', '.', $formattedValue);
    
    return floatval($formattedValue);
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// importando conexão com o banco de dados
include ('../../config/dbConnection.php');

$conn = dbConnection();

// Certificando se conexão foi bem sucedida 
if ($conn->connect_error) {
    $response = [
        'status' => 'error',
        'message' => 'Conexão falhou: ' . $conn->connect_error
    ];
    echo json_encode($response);
    exit();
}

// Certificando se chegaram os dados da outra página via Post pra podermos atribuir as variáveis.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $insumo = $_POST['insumo'];

    switch ($_POST['unidade-medida']) {
        case "kg":
            $unidade_medida = "g";
            break;
        case "l":
            $unidade_medida = "ml";
            break;
        case "g":
        case "ml":
        case "un":
            $unidade_medida = $_POST['unidade-medida'];
            break;
        default:
            $unidade_medida = "un"; // Valor padrão, caso nenhuma unidade válida seja selecionada
            break;
    }

    $custo_insumo = ($_POST['unidade-medida'] == "kg" || $_POST['unidade-medida'] == "l" ? formatToFloat($_POST['custo-unitario']) / 1000 : formatToFloat($_POST['custo-unitario']));
    $custo_total = formatToFloat($_POST['custo-total']);
    $qntd_estoque_insumo = ($_POST['unidade-medida'] == "kg" || $_POST['unidade-medida'] == "l" ? intval($_POST['estoque-atual']) * 1000 : intval($_POST['estoque-atual']));
    $data_validade = $_POST['data-validade'];
    $data_cadastro = date('Y-m-d');

    // Preparar a consulta SQL para inserção na tabela insumo
    $stmt = $conn->prepare("INSERT INTO insumo (nome, unidade_medida, custo_unitario, custo_total, estoque_atual, data_validade, data_cadastro) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddiss", $insumo, $unidade_medida, $custo_insumo, $custo_total, $qntd_estoque_insumo, $data_validade, $data_cadastro);

    // Executar a consulta
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
