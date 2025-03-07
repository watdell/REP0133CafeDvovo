<?php
include '../../../serverside/config/dbConnection.php';

$conn = dbConnection();

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "SELECT * FROM orcamento";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id_orcamento"] . " - RD: " . $row["registro_data"] . " VD: " . $row["vencimento_data"] . " IDC: " . $row["id_cliente"] . "<br>";
    }
} else {
    echo "0 results";
}

$sql = "SELECT * FROM itemorcamento";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "idI: " . $row["id_itemorcamento"] . " - ID: " . $row["id_orcamento"] . " NP: " . $row["nome_produto"] . " VP: " . $row["valor_produto"] . " DesC: " . $row["descricao"] . " IDC: " . $row["quantidade"] . "<br>";
    }
} else {
    echo "0 results";
}

// Fecha a conexão
$conn->close();
?>
