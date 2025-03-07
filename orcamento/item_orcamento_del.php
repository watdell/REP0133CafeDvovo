<?php

include '../../../serverside/config/dbConnection.php';
$counter = 0;
$next = 0;

// Establish DB connection
$conn = dbConnection();
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

$lastId = $conn->insert_id;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['to_be_del'])) {
        $data = filter_var($_POST['to_be_del'], FILTER_SANITIZE_STRING);
        // Your processing logic here
        $items_del = $_POST['to_be_del'];
        foreach ($items_del as $item_del) {
            echo htmlspecialchars($item_del) . "<br>";
    
            // Prepare SQL query using placeholders for security
            $sql = "DELETE FROM itemorcamento WHERE id_itemorcamento = '$item_del';";
    
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
        }
    } else {
        echo 'null';
        $stmt->close();
        $conn->close();
        header("Location: ../../../public/comercial/orcamento/orcamento.php");
    };
} else {
    echo "This script only handles POST requests.";
};

// Close the statement and connection
$stmt->close();
$conn->close();

header("Location: ../../../public/comercial/orcamento/orcamento.php");
?>
