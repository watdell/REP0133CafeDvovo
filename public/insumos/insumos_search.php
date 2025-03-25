<?php
$q = strval($_GET['q']);
$t = 'insumo';

include '../../serverside/config/dbConnection.php';

// Conexão com a database
$conn = dbConnection();
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Gerando a query SQL
$sql="SELECT * FROM $t WHERE nome LIKE '%".$q."%' ORDER BY nome ASC";
$stmt= $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


echo
'<div class="table-header">
<a style="width:11.11111%">ID</a>|
<a style="width:11.11111%">nome</a>|
<a style="width:11.11111%">unidade de medida</a>|
<a style="width:11.11111%">custo unitário</a>|
<a style="width:11.11111%">estoque atual</a>|
<a style="width:11.11111%">data de validade</a>|
<a style="width:11.11111%">data de cadastro</a>|
<a style="width:11.11111%">editar</a>|
<a style="width:11.11111%">excluir</a>';
echo '</div><hr style="height:4px;background-color:black">';

while($row = mysqli_fetch_array($result)) {
    echo 
        "<div class='itens_shown'>
        <a name='id_sel' value='" . $row["insumo_id"] . "'>" . $row["insumo_id"] . "</a>|
        <a>" . $row['nome'] . "</a>|
        <a>" . $row['unidade_medida'] . "</a>|
        <a>" . $row['custo_unitario'] . "</a>|
        <a>" . $row['estoque_atual'] . "</a>|
        <a>" . $row['data_validade'] . "</a>|
        <a>" . $row['data_cadastro'] . "</a>|

        <a>
        <form method='POST' action='editar.php'>
        <input hidden value='" . $row["insumo_id"] . "' name='id_sel'> 
        <button type='submit'>Edição</button>  
        </form>
        </a>|

        <a><button onclick='confirmarExclusao(" . $row['insumo_id'] . ")'>Excluir</button></a>";

        echo "</div><hr>";
}
$stmt->close();
$conn->close();

mysqli_close($conn);
       
       