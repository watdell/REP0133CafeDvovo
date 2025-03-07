<?php
header('Content-Type: application/json');

$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : '';

include ('../../config/dbConnection.php');

$conn = dbConnection();

$sql = "SELECT produto_id, nome, descricao, tipo, peso, custo, margem_lucro, estoque_atual, estoque_minimo, data_validade, data_cadastro, preco_venda FROM produto";

if ($criterio) {
    $sql.= "WHERE nome LIKE '%" .$conn->real_escape_string($criterio) . "%'";
}

$result = $conn->query($sql);

$insumos = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $insumos[] = $row;
    }
}

$conn->close();

echo json_encode($insumos);
?>