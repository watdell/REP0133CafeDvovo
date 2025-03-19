<?php
    include '../../serverside/queries/db_queries.php';
    include '../../serverside/config/dbConnection.php';
    include '../../includes/main-sidebar.php';

    $conn = dbConnection();
    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }



if($_SERVER ['REQUEST_METHOD']=="POST" && $_POST['action']=='delete'){
    $id = $_POST['insumo_id'];
    echo $id;
    $sql = "DELETE FROM insumo WHERE insumo_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    }

?>