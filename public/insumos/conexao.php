<?php
    include '../../serverside/queries/db_queries.php';
    include '../../serverside/config/dbConnection.php';
    include '../../includes/main-sidebar.php';

    $conn = dbConnection();
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    if ($_SERVER ['REQUEST_METHOD']=="POST" && $_POST['action']=='create'){

    $nome= $_POST['nome'];
    echo $nome;
    $unidade_medida = $_POST['unidade_medida'];
    echo $unidade_medida;
    $custo_unitario = $_POST['custo_unitario'];
    echo $custo_unitario;
    $estoque_atual = $_POST['estoque_atual'];
    echo $estoque_atual;
    $data_validade = $_POST['data_validade'];
    echo $data_validade;

    $sql= "INSERT INTO insumo (nome, unidade_medida, custo_unitario, estoque_atual, data_validade, data_cadastro) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdis", $nome, $unidade_medida,  $custo_unitario, $estoque_atual, $data_validade);
    $stmt->execute();
    }

?>
 
 
 
 
 
