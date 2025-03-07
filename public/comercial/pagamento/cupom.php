<?php
// Inicia uma sessão para garantir que o arquivo pagamento.php acesse variáveis de processamento-pag.php
session_start();

// Garantindo que o usuário final não consiga acessar este arquivo
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cupom = $_POST['cupom'];
    $precoTotal = isset($_SESSION['precoTotal']) ? $_SESSION['precoTotal'] : "";
} else {
    // Volta para a página de vendas caso o usuário não entre por meio da mesma
    header("refresh: 0; url=../venda/venda-testes-pagamento.php"); // Somente para testes !!! TROCAR DEPOIS !!!
    //header("refresh: 1; url=../venda/venda.php");
    exit;
}

// Gerando a conexão com o banco de dados
require_once '../../../serverside/config/dbConnection.php';
$conn = dbConnection();

// Mostrando estado da conexão (testes)
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!" . "<br>";
}

$sql = "CREATE TABLE if not exists cupom(
    codcupom VARCHAR(255) NOT NULL PRIMARY KEY,
    desconto FLOAT NOT NULL
)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Check if the statement was prepared successfully
if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Statement prepared successfully" . "<br>";
} else {
    echo "Error: " . $stmt->error . "<br>";  // Output the error related to the statement execution
}

/*

$sql = "INSERT INTO cupom (codcupom, desconto)
VALUES
('N3V3RG0NN4G1V3Y0U4PP', 99.99),
('ILIKECOFFEE!', 10),
('FOLLOWCAFEDVOVO', 5),
('TOAST', 2),
('TOASTEDCOFFEE', 20),
('KITCAFE', 5),
('CAFEDVOVO', 3)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
  
*/
/*
$sql = "SELECT * FROM cupom";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "cod: " . $row["codcupom"] . " - desconto: " . $row["desconto"] . "<br>";
    }
} else {
    echo "0 results";
}
*/

$sql = "SELECT desconto FROM cupom WHERE codcupom = '$cupom'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "cod: " . $row["desconto"] . "<br>";
        $precoTotal = $precoTotal * ($row["desconto"] / 100);
        $_SESSION['precoTotal'] = (float)$precoTotal;
        header("refresh: 0; url=pagamento.php");
        echo "$precoTotal";
    }
} else {
    echo "0 results";
}

$conn->close();