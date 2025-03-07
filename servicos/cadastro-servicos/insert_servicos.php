<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tipo= $_POST["tipo"];
$preco= $_POST["preco"];
$precification= $_POST["precificacao"];

include '../../../serverside/config/dbConnection.php'; 

$conn = dbConnection();

$stmt= $conn->prepare("INSERT INTO servicos (tipo_servico, preco, precificacao) VALUES (?,?,?);");
$stmt->bind_param('sds' , $tipo,$preco ,$precification);


if ($stmt->execute()){
    echo "Serviço inserido comn sucesso!! redirecionando";
    header("Refresh: 2; url=servicos_home.php");
}else{ 
    echo "Erro ao inserir o serviço".$conn->connect_error;
}
?>