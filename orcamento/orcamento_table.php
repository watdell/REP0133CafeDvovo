<?php
include '../../../serverside/config/dbConnection.php';

// Get client ID from POST
$cliente = $_POST['client_p'];

// Create DateTime object and add 3 months
$vencDate = new DateTime();
$vencDate->modify('+3 months');
$date = $vencDate->format('Y-m-d H:i:s');
$counter = 0;
$next = 0;

// Establish DB connection
$conn = dbConnection();

// Check if the connection was successful
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Prepare SQL query using placeholders for security
$sql = "INSERT INTO orcamento (id_cliente, vencimento_data) VALUES (?, ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Bind the parameters to the prepared statement
$stmt->bind_param("is", $cliente, $date);  // "i" for integer, "s" for string

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;  // Output the error related to the statement execution
};

$lastId = $conn->insert_id;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'item' array is set and process the array
    if (isset($_POST['item'])) {
        $items = $_POST['item'];  // This is the array of submitted values
        
        // Loop through the array and output each item
        echo "You submitted the following items:<br>";
        foreach ($items as $item) {
            $counter++;  // Increment the counter

            // Check if the current counter is divisible by 5
            if ($counter % 5 == 0) {
                
                $sql = "INSERT INTO itemorcamento (id_orcamento, nome_produto, descricao, quantidade, valor_produto) VALUES (?, ?, ?, ?, ?)";

                // Prepare the statement
                $stmt = $conn->prepare($sql);

                // Check if the statement was prepared successfully
                if ($stmt === false) {
                    die("Erro ao preparar a consulta: " . $conn->error);
                }

                // Bind the parameters to the prepared statement
                $stmt->bind_param("issid", $lastId, $items[$next + 3], $items[$next + 1], $items[$next + 4], $items[$next + 2]);  // "i" for integer, "s" for string

                // Execute the prepared statement
                if ($stmt->execute()) {
                    echo "Success";
                } else {
                    echo "Error: " . $stmt->error;  // Output the error related to the statement execution
                }
                $next = $next + 5;
            }
        }
    } else {
        echo "No items were submitted.";
    }
} else {
    echo "Invalid request method.";
}

// Close the statement and connection
$stmt->close();
$conn->close();

header("Location: ../../../public/comercial/orcamento/orcamento.php");
?>
