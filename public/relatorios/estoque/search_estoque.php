<?php
// Coletando variáveis
$q = strval($_GET['q']);
$t = strval($_GET['t']);

// Connectando com a DataBase
include '../../../serverside/config/dbConnection.php';
$conn = dbConnection();
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
};

// Função que processa o valor mínimo e retorna uma div estilizada
function VerificarEstoque($atual, $min) {
    $div = '';
    if ($atual > $min) {
        $div = 
        '<div class="disponivel">
            <a>Disponível</a>
        </div>';
    } elseif ($atual < $min && $atual != 0) {
        $div = 
        '<div class="escasso">
            <a>Escasso</a>
        </div>';
    } else {
        '<div class="indisponivel">
            <a>Indisponível</a>
        </div>';
    }

    return $div;
}


// Gerando a query SQL
$sql="SELECT * FROM $t WHERE nome LIKE '%".$q."%'";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

if ($t == 'produto') {

    echo
    '<div class="table_header">
    <a style="width:20%">ID</a>
    <a style="width:20%">nome</a>
    <a style="width:20%">data</a>
    <a style="width:20%">estoque</a>
    <a style="width:20%">status</a>';
    echo '</div><hr style="height:4px;background-color:black">';

    while($row = mysqli_fetch_array($result)) {
        echo 
            "<div class='itens_shown'>
            <a style='width:20%;overflow:hidden;'>" . $row['produto_id'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['nome'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['data_cadastro'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['estoque_atual'] . "</a>";
            echo VerificarEstoque($row['estoque_atual'], $row['estoque_minimo']);

            echo "</div><hr>";
    }

} else if ($t == 'insumo') {

    echo '<div class="table_header">
    <a style="width:20%">ID</a>
    <a style="width:20%">nome</a>
    <a style="width:20%">data</a>
    <a style="width:20%">estoque</a>
    <a style="width:20%">status</a>';
    echo '</div><hr style="height:4px;background-color:black">';

    while($row = mysqli_fetch_array($result)) {
        echo "<div class='itens_shown'>
            <a style='width:20%;overflow:hidden;'>" . $row['insumo_id'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['nome'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['data_cadastro'] . "</a>
            <a style='width:20%;overflow:hidden;'>" . $row['estoque_atual'] . "</a>";
            echo VerificarEstoque($row['estoque_atual'], $row['estoque_minimo']);
            echo "</div><hr>";
        }
}

$stmt->close();
