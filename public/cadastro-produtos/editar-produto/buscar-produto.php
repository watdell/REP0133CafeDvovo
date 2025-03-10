<?php
header('Content-Type: application/json');

include ('../../../serverside/config/dbConnection.php');

$conn = dbConnection();

$sql = "SELECT * FROM insumo";

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