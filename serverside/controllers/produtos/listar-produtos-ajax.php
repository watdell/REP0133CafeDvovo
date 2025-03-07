<?php
// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Verifica se o parâmetro 'criterio' foi passado na URL e o armazena na variável, ou define como uma string vazia
$criterio = isset($_GET['criterio']) ? $_GET['criterio'] : '';

// Inclui o arquivo de conexão com o banco de dados
include ('../../config/dbConnection.php');

$conn = dbConnection();

// Define a consulta SQL para selecionar os campos desejados da tabela 'produto'
$sql = "SELECT produto_id, nome, descricao, tipo, peso, custo, margem_lucro, estoque_atual, estoque_minimo, data_validade, data_cadastro, preco_venda FROM produto";

// Se um critério de busca foi passado, adiciona uma cláusula WHERE para filtrar os resultados
if ($criterio) {
    // Adiciona a cláusula WHERE, utilizando LIKE para permitir busca parcial no nome do produto
    $sql .= " WHERE nome LIKE '%" . $conn->real_escape_string($criterio) . "%'";
}

// Executa a consulta SQL no banco de dados
$result = $conn->query($sql);

// Inicializa um array vazio para armazenar os produtos encontrados
$produto = [];

// Verifica se há resultados na consulta
if ($result->num_rows > 0) {
    // Se houver resultados, percorre cada linha e adiciona ao array 'produto'
    while($row = $result->fetch_assoc()) {
        $produto[] = $row;
    }
}

// Fecha a conexão com o banco de dados
$conn->close();

// Retorna o array de produtos como uma resposta JSON
echo json_encode($produto);

/***********
A função json_encode($insumos) transforma o array $insumos, que contém os produtos, em uma string JSON.

A partir dessa resposta JSON, a função Ajax no JavaScript vai pegar essa resposta [que é uma lista de objetos (Comparado a uma lista de dicionários no python..)] e processá-la, listando os resultados em um loop.
A cada iteração do loop, você pode acessar as informações dos produtos como atributos, por exemplo, produto.nome, produto.descricao, etc.

Resumindo:
json_encode($insumos): Codifica o array de produtos.
Ajax (lá no html ou php que fez a requisição à esse arquivo aqui): Recebe a resposta JSON e itera sobre ela, acessando os atributos de cada produto.

************/
?>
