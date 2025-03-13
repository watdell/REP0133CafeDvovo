<?php

    include 'serverside/config/dbConnection.php';

    $conn = dbConnection();

    function DateMod($mod) {
        $vencDate = new DateTime();
        $vencDate->modify($mod);
        return $vencDate->format('Y-m-d H:i:s');
    };

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    $sql= "SELECT data FROM entradas WHERE data > '" . DateMod('-30 day') . "' GROUP BY DAY(data) ORDER BY data ASC";
    $stmt= $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result(); 

    while($row = $result->fetch_assoc()) {
    }