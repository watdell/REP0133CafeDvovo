<?php
// Inicia uma sessão para garantir que o arquivo pagamento.php acesse variáveis de processamento-pag.php
session_start();

// Garantindo que o usuário final não consiga acessar este arquivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' || $_SESSION['cupomed'] == true) {
    // Adquirindo Variáveis da página Vendas
    $codVenda = $_POST['codigoVenda'];
    $codOrcamento = $_POST['codigoOrcamento'];
    echo "código de venda: " . $codVenda . "<br>";
    echo "código de orçamento: " . $codOrcamento . "<br>";  
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



// Coletando dados a partir da tabela itemorcamentos
$produtos = array();

$sql = "SELECT * FROM itemorcamento WHERE id_orcamento='$codOrcamento'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "idI: " . $row["id_itemorcamento"] . " - ID: " . $row["id_orcamento"] . " NP: " . $row["nome_produto"] . " VP: " . $row["valor_produto"] . " DesC: " . $row["descricao"] . " IDC: " . $row["quantidade"] . "<br>";
        $produtos[] = array($row["nome_produto"], $row["valor_produto"], $row["quantidade"], $row["valor_produto"] * $row["quantidade"]);
    }
} else {
    echo "0 results";
}

// Calculando Total
$total = 0;
foreach ($produtos as $i) {
    echo "$i[0] $i[1] $i[2] $i[3] <br>";
    $total = $total + $i[3];
  }


// Passando valores para a sessão
$_SESSION['codVenda'] = $codVenda;
$_SESSION['codOrcamento'] = $codOrcamento;
$_SESSION['produtos'] = $produtos;
$_SESSION['precoTotal'] = $total;

// Fechando conexão com o banco de dados
$conn->close();

// Redirecionando após a execução do código
header("refresh: 0; url=pagamento.php");
exit;