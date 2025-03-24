<?php
    include '../../serverside/queries/db_queries.php';
    include '../../serverside/config/dbConnection.php';
    include '../../includes/main-sidebar.php';

    $conn = dbConnection();
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $unidade_medida = $_POST['unidade_medida'];
        $custo_unitario = $_POST['custo_unitario'];
        $estoque_atual = $_POST['estoque_atual'];
        $data_validade = $_POST['data_validade'];

        
        echo $id . "<br>";
        echo $nome . "<br>";
        echo $unidade_medida . "<br>";
        echo $custo_unitario . "<br>";
        echo $estoque_atual . "<br>";
        echo $data_validade . "<br>";

        $sql = "UPDATE insumo 
                SET nome = ?, unidade_medida = ?, custo_unitario = ?, estoque_atual = ?, data_validade = ?
                WHERE insumo_id = ?";

        $stmt = $conn->prepare($sql);
        
        if (!$stmt) {
            die("Erro na preparação da query: " . $conn->error);
        }

        
        $stmt->bind_param("ssdisi", $nome, $unidade_medida, $custo_unitario, $estoque_atual, $data_validade, $id);

        $stmt->execute();

      
        
    }
?>
