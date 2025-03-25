<?php
$q = isset($_GET['q']) ? strval($_GET['q']) : '';
$t = 'insumo';

include '../../serverside/config/dbConnection.php';

// Conexão com a database
$conn = dbConnection();
if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

try {
    // Gerando a query SQL usando prepared statement corretamente
    $sql = "SELECT * FROM $t WHERE nome LIKE ? ORDER BY nome ASC";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Erro na preparação da query: " . $conn->error);
    }
    
    $searchTerm = "%" . $q . "%";
    $stmt->bind_param("s", $searchTerm);
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

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo 
                "<div class='itens_shown'>
                <a name='id_sel' value='" . htmlspecialchars($row["insumo_id"]) . "'>" . htmlspecialchars($row["insumo_id"]) . "</a>|
                <a>" . htmlspecialchars($row['nome']) . "</a>|
                <a>" . htmlspecialchars($row['unidade_medida']) . "</a>|
                <a>" . htmlspecialchars($row['custo_unitario']) . "</a>|
                <a>" . htmlspecialchars($row['estoque_atual']) . "</a>|
                <a>" . htmlspecialchars($row['data_validade']) . "</a>|
                <a>" . htmlspecialchars($row['data_cadastro']) . "</a>|

                <a>
                <form method='POST' action='editar.php'>
                <input hidden value='" . htmlspecialchars($row["insumo_id"]) . "' name='id_sel'> 
                <button type='submit'>Edição</button>  
                </form>
                </a>|

                <a><button onclick='confirmarExclusao(" . htmlspecialchars($row['insumo_id']) . ")'>Excluir</button></a>";

                echo "</div><hr>";
        }
    } else {
        echo "<div>Nenhum resultado encontrado</div>";
    }
    
    $stmt->close();
    $conn->close();
    
} catch (Exception $e) {
    // Log the error for debugging
    error_log("Error in insumos_search.php: " . $e->getMessage());
    
    // Send proper error response
    http_response_code(500);
    echo "Ocorreu um erro ao processar sua solicitação. Por favor, tente novamente.";
    exit;
}