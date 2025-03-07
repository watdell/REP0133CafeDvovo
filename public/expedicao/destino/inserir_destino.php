<?php


$name = $_POST['name'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];

//echo ' '.$name.' '.$cep.' '.$rua.' '.$bairro.' '.$cidade.' '.$estado.'';

include '../../../serverside/config/dbConnection.php';

$conn = dbConnection();


$sql = 'INSERT INTO destino (nome_lugar, CEP, Logradouro, Bairro, Cidade, Estado) VALUES (?,?,?,?,?,?)';

$stmt = $conn->prepare(query: $sql);

$stmt->bind_param("ssssss", $name, $cep, $rua, $bairro, $cidade, $estado);

if($stmt->execute()) {
    echo "Adicionado com sucesso";
} else {
    echo 'Erro'.$conn->connect_error;
}

$sql2 = "select* from destino";

$stmt2 = $conn->prepare(query: $sql2);

$stmt2->execute();

//$result2 = $stmt2->get_result();

//while($row = $result2->fetch_assoc()) {
//    echo "<br> ".$row["nome_lugar"]." ".$row["CEP"]." ".$row["Logradouro"]." ".$row["Bairro"]." ".$row['Cidade']." ".$row['Estado'];
//}

header("Refresh: 2; url=destino.php");



?>