<?php

include ('../../config/dbConnection.php');

$conn = dbConnection();

//$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$id = $_GET['id'];
//$id = "99"; para debug..

$sql = "SELECT
        produto.*, /* Aqui eu estou selecionando todos os campos da tabela produto */
        insumo.nome AS nome_insumo,
        insumo.custo_unitario,
        insumo.unidade_medida, /* Tive que chamar o campo nome da tabela insumo de nome_insumo pq na tabela produto já tem um campo chamado nome. */
        produto_insumo.qntd_insumo /* Seleciono o campo de quantidade na tabela produto_insumo */
        FROM produto /* Esta cláusula indica a tabela principal da qual os dados estão sendo extraídos, que é a tabela 'produto'. */
        JOIN produto_insumo ON produto.produto_id = produto_insumo.produto_id /* Esta cláusula une a tabela produto com a tabela produto_insumo onde o ID do produto na tabela produto coincide com o ID na tabela produto_insumo. */
        JOIN insumo ON produto_insumo.insumo_id = insumo.insumo_id /* Aqui, estou unindo a tabela insumo à tabela produto_insumo, buscando os insumos relacionados ao produto pelo seu ID. */
        WHERE produto.produto_id = ?"; /* Esta cláusula filtra os resultados para trazer apenas o produto com o ID especificado (o ID será passado como parâmetro). */

$stmt = $conn->prepare($sql);

if ($stmt) {

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    /* if ($row = $result->fetch_assoc()) {
        // Aqui eu itero sobre os campos da primeira linha retornada
        foreach($row as $key => $value) {  
            echo "$key: $value<br>"; // Exibe cada chave e seu respectivo valor
        }
    
        // Agora, uso um do-while para iterar sobre as linhas restantes do resultado
        do {
            // Aqui eu exibo o nome do insumo e sua quantidade
            echo "Insumo: " . $row['nome_insumo'] . " Quantidade: " . $row['qntd_insumo'] . "<br>";
        } while ($row = $result->fetch_assoc()); // Continua buscando e exibindo linhas enquanto houver resultados
    }*/

    $produto = null; // Crio um array para armazenar os dados do produto

    while ($row = $result->fetch_assoc()) {

        if($produto === null) {
            
            $produto = [
                'produto_id' => $row['produto_id'],
                //'imagem' => $row['imagem'],
                'tipo_imagem' => $row['tipo_imagem'],
                'nome' => $row['nome'],
                'categoria' => $row['categoria'],
                'descricao' => $row['descricao'],
                'tipo' => $row['tipo'],
                'peso' => $row['peso'],
                'custo' => $row['custo'],
                'margem_lucro' => $row['margem_lucro'],
                'preco_venda' => $row['preco_venda'],
                'estoque_atual' => $row['estoque_atual'],
                'estoque_minimo' => $row['estoque_minimo'],
                'data_validade' => $row['data_validade'],
                'data_cadastro' => $row['data_cadastro'],
                'insumos' => [] // Cria um array para insumos
            ];
        
        }

        // Adiciono insumos à lista de insumos do produto
        $produto['insumos'][] = [
            'nome_insumo' => $row['nome_insumo'],
            'qntd_insumo' => $row['qntd_insumo'],
            'custo_unitario' => $row['custo_unitario'],
            'unidade_medida' => $row['unidade_medida']
        ];
    }
    // Essa é a array em forma de json que eu envio como resposta para minha função ajax receber e manipular
    echo json_encode($produto);

    $produto = null;
    $stmt->close();
    $conn->close();
}

/*
 O procedimento acima é para os dados serem enviados como resposta a função Ajax dessa forma:

    {
    "produto_id": 99,
    "imagem": "",
    "tipo_imagem": "",
    "nome": "cafe top imagem 20",
    "categoria": "",
    "descricao": "cafe top imagem top 20",
    "tipo": "pacote",
    "peso": 200,
    "custo": 7,
    "margem_lucro": 20,
    "preco_venda": 8.4,
    "estoque_atual": 1,
    "estoque_minimo": 0,
    "data_validade": "2025-12-31",
    "data_cadastro": "2024/11/02",
    "insumos": [
        {
            "nome_insumo": "Café em Grãos",
            "qntd_insumo": 100
        },
        {
            "nome_insumo": "Leite",
            "qntd_insumo": 120
        }
    ]
}

*/

?>
