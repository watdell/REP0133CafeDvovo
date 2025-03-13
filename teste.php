<?php

    include 'serverside/config/dbConnection.php';

    $conn = dbConnection();

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }


    $sql= "SELECT data, SUM(valor) AS valor_diario FROM $table WHERE data > '" . DateMod($mod) . "' $TypeDate ORDER BY data ASC";
        $stmt= $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 

        while($row = $result->fetch_assoc()) {
        }