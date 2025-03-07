<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id= $_GET["id"];


include '../../../serverside/config/dbConnection.php'; 

$conn = dbConnection();

$stmt = $conn->prepare("DELETE FROM servicos WHERE id_servicos = ?");
$stmt->bind_param('i', $id); // Substitua 'i' por 's' se o ID for uma string


if ($stmt->execute()){
    echo "Serviço inserido comn sucesso!! redirecionando";
    header("Refresh: 2; url=servicos_home.php");
}else{ 
    echo "Erro ao inserir o serviço".$conn->connect_error;
}
?>