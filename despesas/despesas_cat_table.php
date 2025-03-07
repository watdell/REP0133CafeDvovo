<?php
include '../../../serverside/config/dbConnection.php';

// Get client ID from POST
$tipo = $_POST['tipo'];
$nome = $_POST['nome'];

// Establish DB connection
$conn = dbConnection();

// Check if the connection was successful
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Prepare SQL query using placeholders for security
$sql = "INSERT INTO despesa_categoria (tipo, nome) VALUES (?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Bind the parameters to the prepared statement
$stmt->bind_param("ss", $tipo, $nome);  // "i" for integer, "s" for string

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;  // Output the error related to the statement execution
};

// Close the statement and connection
$stmt->close();
$conn->close();

header("Location: despesas_create.php");

?>
