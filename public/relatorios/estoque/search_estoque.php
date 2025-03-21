<?php
// Coletando variáveis
$q = strval($_GET['q']);
$t = strval($_GET['t']);

// Conectando com a DataBase
include '../../../serverside/config/dbConnection.php';
$conn = dbConnection();
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Função que processa o valor mínimo e retorna uma div estilizada
function VerificarEstoque($atual, $min) {
    $div = '';

    if ($atual == 0) {
        $div = 
        '<div class="indisponivel">
            <a>Indisponível</a>
        </div>';
    } elseif ($atual > $min) {
        $div = 
        '<div class="disponivel">
            <a>Disponível</a>
        </div>';
    } elseif ($atual < $min && $atual > 0) {
        $div = 
        '<div class="escasso">
            <a>Escasso</a>
        </div>';
    }

    return $div;
}

// Gerando a query SQL
$sql = "SELECT * FROM $t WHERE nome LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $q . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

// Cabeçalho da Tabela
echo '<div class="table_header">
<a style="width:20%">ID</a>
<a style="width:20%">Nome</a>
<a style="width:20%">Data</a>
<a style="width:20%">Estoque</a>
<a style="width:20%">Status</a>';
echo '</div><hr style="height:4px;background-color:black">';

// Verificação de tipo (produto ou insumo)
while ($row = $result->fetch_assoc()) {
    if ($t == 'produto') {
        echo "<div class='itens_shown'>
            <a style='width:20%;overflow:hidden;'>" . $row['produto_id'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['nome'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['data_cadastro'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['estoque_atual'] . "</a>";
        echo VerificarEstoque($row['estoque_atual'], $row['estoque_minimo']);
        echo "</div><hr>";
    } elseif ($t == 'insumo') {
        echo "<div class='itens_shown'>
            <a style='width:20%;overflow:hidden;'>" . $row['insumo_id'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['nome'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['data_cadastro'] . "</a><span>|</span>
            <a style='width:20%;overflow:hidden;'>" . $row['estoque_atual'] . "</a>";
        echo VerificarEstoque($row['estoque_atual'], $row['estoque_minimo']);
        echo "</div><hr>";
    }
}

$stmt->close();
$conn->close();
?>
