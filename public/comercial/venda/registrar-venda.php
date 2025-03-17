<?php
include('../../../serverside/config/dbConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = dbConnection();

    // Pegando os dados do formulário
    $cliente = $_POST['cliente'];
    $desconto = floatval(str_replace(',', '.', $_POST['desconto'])); // Convertendo para float
    $total = 0;

    // Pegando os produtos da venda
    $produtos = $_POST['produto']; // Array de produtos
    $quantidades = $_POST['qntd-produto']; // Array de quantidades
    $valores_unit = $_POST['valor-unit']; // Array de valores unitários
    $subtotais = $_POST['sub-total']; // Array de subtotais

    // Convertendo os subtotais para número (caso estejam no formato com vírgula)
    foreach ($subtotais as $key => $subtotal) {
        $subtotais[$key] = floatval(str_replace(',', '.', $subtotal));
    }
    // Calculando o total da venda
    $total = array_sum($subtotais) - $desconto;

    // Inserindo a venda na tabela "vendas"
    $stmt = $conn->prepare("INSERT INTO vendas (cliente_id, total) VALUES (?, ?)");
    $stmt->bind_param("id", $cliente, $total);
    
    if ($stmt->execute()) {
        $id_venda = $stmt->insert_id; // Pegando o ID da venda recém-inserida

        // Inserindo os produtos na tabela "itens_venda"
        $stmt_item = $conn->prepare("INSERT INTO itens_venda (venda_id, produto, quantidade, preco_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt_item->bind_param("isidd", $id_venda, $produto, $quantidade, $preco_unitario, $subtotal);

        // Percorrendo os produtos e inserindo um a um
        for ($i = 0; $i < count($produtos); $i++) {
            $produto = $produtos[$i];
            $quantidade = intval($quantidades[$i]);
            $preco_unitario = floatval(str_replace(',', '.', $valores_unit[$i]));
            $subtotal = $subtotais[$i];

            $stmt_item->execute();
        }

         // Mensagem de sucesso e redirecionamento
         echo "<h2>Venda cadastrada com sucesso!</h2>";
         echo "<p>Você será redirecionado em 1 segundos...</p>";
         echo '<meta http-equiv="refresh" content="1;url=\'../caixa/caixa.php\'">';
 
    } else {
        echo "Erro ao cadastrar a venda: " . $stmt->error;
    }

    // Fechando as conexões
    $stmt->close();
    $stmt_item->close();
    $conn->close();
} else {
    echo "Método inválido.";
}
?>
