<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id= $_POST["id"];
$tipo= $_POST["tipo"];
$preco= $_POST["preco"];
$precificacao= $_POST["precificacao"];


include '../../../serverside/config/dbConnection.php'; 

$conn = dbConnection();

$stmt = $conn->prepare("UPDATE servicos SET tipo_servico = ?, preco= ?, precificacao=? WHERE id_servicos=?");
$stmt->bind_param('sdsi', $tipo, $preco, $precificacao,$id); 


if ($stmt->execute()){
    echo "Serviço inserido comn sucesso!! redirecionando";
    header("Refresh: 2; url=servicos_home.php");
}else{ 
    echo "Erro ao inserir o serviço".$conn->connect_error;
}
?>