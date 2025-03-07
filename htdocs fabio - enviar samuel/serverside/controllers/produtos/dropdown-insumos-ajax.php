<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

include ('../../config/dbConnection.php');

$conn = dbConnection();

$sql = "SELECT insumo_id, nome, custo_unitario, unidade_medida, estoque_atual, data_validade FROM insumo";

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