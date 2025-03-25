<?php
// Inicializa o cURL
$ch = curl_init();

// Desabilita a verificação do certificado SSL (não recomendado para produção)
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Define o tipo de resposta como JSON
header("Content-Type: application/json");

// Chave de API do Melhor Envio (substitua pela sua)
$api_key = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NTYiLCJqdGkiOiI0NzI4YWY3ZDA4YzE2NTRjNDk3ODE1ODQwZGE0NzFhZjk0MDM1NGM2MjY4Njc3YjE3OWZkZDdlOGVjZTNkMjAzN2I0MWY1YzU5MGRmOWY0YSIsImlhdCI6MTc0MjQxMjQ4OC42NzYwOTEsIm5iZiI6MTc0MjQxMjQ4OC42NzYwOTMsImV4cCI6MTc3Mzk0ODQ4OC42NjQzNjgsInN1YiI6IjllNzhhYmU3LTllZGMtNDgwMi05ZmE5LWRiYmU3MTEwOWQwYyIsInNjb3BlcyI6WyJjYXJ0LXJlYWQiLCJjYXJ0LXdyaXRlIiwiY29tcGFuaWVzLXJlYWQiLCJjb21wYW5pZXMtd3JpdGUiLCJjb3Vwb25zLXJlYWQiLCJjb3Vwb25zLXdyaXRlIiwibm90aWZpY2F0aW9ucy1yZWFkIiwib3JkZXJzLXJlYWQiLCJwcm9kdWN0cy1yZWFkIiwicHJvZHVjdHMtZGVzdHJveSIsInByb2R1Y3RzLXdyaXRlIiwicHVyY2hhc2VzLXJlYWQiLCJzaGlwcGluZy1jYWxjdWxhdGUiLCJzaGlwcGluZy1jYW5jZWwiLCJzaGlwcGluZy1jaGVja291dCIsInNoaXBwaW5nLWNvbXBhbmllcyIsInNoaXBwaW5nLWdlbmVyYXRlIiwic2hpcHBpbmctcHJldmlldyIsInNoaXBwaW5nLXByaW50Iiwic2hpcHBpbmctc2hhcmUiLCJzaGlwcGluZy10cmFja2luZyIsImVjb21tZXJjZS1zaGlwcGluZyIsInRyYW5zYWN0aW9ucy1yZWFkIiwidXNlcnMtcmVhZCIsInVzZXJzLXdyaXRlIiwid2ViaG9va3MtcmVhZCIsIndlYmhvb2tzLXdyaXRlIiwid2ViaG9va3MtZGVsZXRlIiwidGRlYWxlci13ZWJob29rIl19.CZFMUCsicuW2jWLSushfLOEDybYR8IjpOz_4qczr5S67PGFXEDiT20N1_i0oiTEhBYTjvfDs25fYMITmISzGnqRQrTqfudkYfTTxAwJ9DzhTX-N2vo4S8oCtQ4n6cO_IJPqwEhKE26rojh2aP7vFJEqauyGwr6-jNMcdBjJKacvBgaAts6b9V6ASWB126gsGR3aezGYcwSNHHH_FKem5X-8_tvch3svSi1kE7-HVYJgx1ePLKTh7V645f9SPrWI1cJ8SkuaQotPTzMj9YQY5ulv36A-zwP_o2ISRPnARVlalXb29VPPG1Y5EjYhfC9l4ZdzN-p5JXtWVATufbj5XvBAIZMzcJ7PWnJdmyhHgDUb0cELtzltATCSNDKk0oRUTcpVVk36qGjPhr-JxKShGRPIa1tk07w8mOn10L2Lt2IZ9xytBEDEifqAD5IsIBNqvB0zC5nujxmOHtAhhcB6FoucMnjqpPdrQk35fadDLFhqN2GRsSEB3jZhvNb0aNlHoTbu9MYujnsVIwMor6x8iJ6WfRMkUWB-Fr9C3pJT7MULBg2kDwZP-Qhtbph9jhC-buVUxtk-xnbniYg9DjYiHYQxDUE883xWpm4UpOIw-SPZvrOw7G5GqnhBSrTaTSUxA2qVecn52icF2wj2P4pUiSbfkMfwbKEfeuPzDHgCkdCM";

// Recebe os dados via POST (do JavaScript)
$cep_origem = $_GET['cep_origem'];
$cep_destino = $_GET['cep_destino'];
$peso = $_GET['peso'];
$valor = $_GET['valor_declarado'];
$largura = $_GET['largura'];
$altura = $_GET['altura'];
$comprimento = $_GET['comprimento'];

// Monta os dados para a requisição
$data = [
    "from" => ["postal_code" => $cep_origem],
    "to" => ["postal_code" => $cep_destino],
    "package" => [
        "weight" => $peso,
        "width" => $largura,
        "height" => $altura,
        "length" => $comprimento
    ],
    "options" => [
        "insurance_value" => $valor, // Valor declarado
        "receipt" => false,  // Aviso de recebimento
        "own_hand" => false // Mão própria
    ]
];

// Verifique os dados que serão enviados
//echo "<pre>";
//var_dump($data);
//echo "</pre>";

// Faz a requisição à API do Melhor Envio
$url = "https://sandbox.melhorenvio.com.br/api/v2/me/shipment/calculate";
curl_setopt($ch, CURLOPT_URL, $url); // Define a URL da requisição
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Define para retornar a resposta
curl_setopt($ch, CURLOPT_POST, true); // Define método POST
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Envia os dados em formato JSON
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $api_key"
]);

// Executa a requisição
$response = curl_exec($ch);

// Verifique se houve algum erro no cURL
if(curl_errno($ch)) {
    echo 'Erro cURL: ' . curl_error($ch);
} else {
    // Verifique o código HTTP da resposta
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    //echo "Código HTTP: $http_code\n";

    // Verifique a resposta da API
    //echo "Resposta da API: " . $response;

    // Se o código HTTP não for 200, provavelmente ocorreu um erro no servidor
    if ($http_code != 200) {
        echo "Erro na resposta da API. Código HTTP: $http_code";
    }

    // Decodifica a resposta JSON, caso a resposta seja JSON válida
    if ($http_code == 200 && $response) {
        $response_data = json_decode($response, true);
        echo json_encode($response_data); // Retorna a resposta da API como JSON
    } else {
        echo "Erro ao processar a resposta da API ou resposta não é JSON.";
    }
}
?>
