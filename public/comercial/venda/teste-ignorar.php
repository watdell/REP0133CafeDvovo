<?php
header('Content-Type: application/json');

// Captura o ID via GET
$id = $_GET['id'] ?? null;

// Verifica se o ID foi enviado e se é numérico
if (!$id || !is_numeric($id)) {
    echo json_encode(["erro" => "ID inválido"]);
    exit;
}

include ('../../../serverside/config/dbConnection.php');

$conn = dbConnection();

$sql = "SELECT produto_id, nome, descricao, tipo, peso, custo, margem_lucro, estoque_atual, estoque_minimo, data_validade, data_cadastro, preco_venda FROM produto WHERE produto_id=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(["erro" => "Erro na preparação da consulta"]);
    exit;
}

$stmt->bind_param("i", $id);

// Executa a consulta
if (!$stmt->execute()) {
    echo json_encode(["erro" => "Erro ao executar a consulta: " . $stmt->error]);
    exit;
}

// Captura o resultado
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

// Fecha conexão
$stmt->close();
$conn->close();

// Se não encontrou nenhum produto, retorna erro
if (!$produto) {
    echo json_encode(["erro" => "Produto não encontrado"]);
    exit;
}

// Retorna os dados do produto em JSON
echo json_encode($produto);
?>
