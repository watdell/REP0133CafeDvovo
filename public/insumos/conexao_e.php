<?php
    include '../../serverside/queries/db_queries.php';
    include '../../serverside/config/dbConnection.php';
    include '../../includes/main-sidebar.php';

    $conn = dbConnection();
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    ($_SERVER ['REQUEST_METHOD']=="POST" && $_POST['action']=='create'){
        $id= $_POST["insumo_id"];
        echo $id . "<br>";
        $nome= $_POST['nome'] ;
        echo $nome . "<br>";
        $unidade_medida = $_POST['unidade_medida'];
        echo $unidade_medida . "<br>";
        $custo_unitario = $_POST['custo_unitario'];
        echo $custo_unitario . "<br>";
        $estoque_atual = $_POST['estoque_atual'];
        echo $estoque_atual . "<br>";
        $data_validade = $_POST['data_validade'];
        echo $data_validade . "<br>";
    }

    sql= "UPDATE  insumo SET insumo (nome, unidade_medida, custo_unitario, estoque_atual, data_validade, data_cadastro) WHERE insumo_id = 1";