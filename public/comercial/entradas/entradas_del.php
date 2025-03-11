<?php
include '../../../serverside/config/dbConnection.php';

$conn = dbConnection();
$item_del = $_POST['id'];

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$sql = "DELETE FROM entradas WHERE identrada = '$item_del';";

// Prepare the statement
$stmt = $conn->prepare($sql);
    
// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;  // Output the error related to the statement execution
};

// Fecha a conexão
$stmt->close();
$conn->close();

header("Location: ../../../public/comercial/entradas/entradas.php");
?>
