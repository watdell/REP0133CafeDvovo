<?php


// Cria a conexão
include '../../serverside/config/dbConnection.php';
$conn = dbConnection();

/*
CREATE TABLE movimentacoes_financeiras (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Identificador único
    tipo_movimentacao VARCHAR(20) NOT NULL, -- Tipo da movimentação (ex.: 'venda_produto', 'compra_insumo', etc.)
    descricao VARCHAR(255) NOT NULL, -- Descrição da movimentação
    valor DECIMAL(10, 2) NOT NULL, -- Valor financeiro
    data_movimentacao DATETIME DEFAULT CURRENT_TIMESTAMP, -- Data e hora da movimentação
    forma_pagamento VARCHAR(50) NOT NULL, -- Forma de pagamento
    observacoes TEXT, -- Campo adicional para observações
    vendas_id INT,
    compras_id INT,
    servicos_id INT ,
    FOREIGN KEY(vendas_id) REFERENCES vendas(idVendas)
    FOREIGN KEY(servicos_id) REFERENCES servicos(id_servicos);
);*/

// Dados recebidos do formulário
$tipo_movimentacao = $_POST['tipo_movimentacao']; // Ex.: 'venda_produto', 'compra_insumo', etc.
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$forma_pagamento = $_POST['forma_pagamento'];
$observacoes = $_POST['observacoes'];

$data = new Date('Y-m-d');

echo $tipo_movimentacao;
echo $descricao;
echo $valor;
echo $forma_pagamento;
echo $observacoes;

echo $data;

/*
// Query de inserção
$sql = "INSERT INTO movimentacoes_financeiras 
        (tipo_movimentacao, descricao, valor, id_usuario, tipo_usuario, forma_pagamento, observacoes) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

// Prepara o statement
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsiss", $tipo_movimentacao, $descricao, $valor, $id_usuario, $tipo_usuario, $forma_pagamento, $observacoes);

// Executa a query
if ($stmt->execute()) {
    echo "Movimentação registrada com sucesso!";
} else {
    echo "Erro ao registrar movimentação: " . $conn->error;
}

// Fecha o statement e a conexão
$stmt->close();
$conn->close();*/
?>
