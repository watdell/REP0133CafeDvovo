<?php

header('Content-Type: application/json');

// Simule sucesso
$response = [
    "success" => true,
    "message" => "Dados inseridos com sucesso!"
];

// Retorne a resposta JSON
echo json_encode($response);




?>