<?php

// Converte os valor em real R$ 1.000,00 vindo da outra página e converte para float pra ser add no banco de dados 1000.00
function converterParaNumero($valor) {
    if (!$valor) {
        return 0;
    }
    
    // Remove pontos (separador de milhar) e substitui vírgula decimal por ponto
    $valorFormatado = str_replace('.', '', $valor);
    $valorFormatado = str_replace(',', '.', $valorFormatado);
    
    return floatval($valorFormatado) ?: 0;
}


include('../../../serverside/config/dbConnection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = dbConnection();

    // Pegando os dados do formulário
    $cliente = $_POST['cliente'];
    $desconto = floatval(str_replace(',', '.', $_POST['desconto'])); // Convertendo para float

    // Pegando os produtos da venda
    $produtos = $_POST['produto']; // Array de produtos
    $quantidades = $_POST['qntd-produto']; // Array de quantidades
    $valores_unit = $_POST['valor-unit']; // Array de valores unitários
    $subtotais = $_POST['sub-total']; // Array de subtotais
    $total = $_POST['total'];

    $nomeFrete = $_POST['nome-frete'];
    $prazoFrete = $_POST['prazo-frete'];
    $valorFrete = $_POST['valor-frete'];
    $dataEntrega = $_POST['dataFormatoBanco'];

    $totalConvertidoFloat = converterParaNumero($total);

    // Convertendo os subtotais para número (caso estejam no formato com vírgula) - errado.. não somava corretamente os valores (corrigir depois.. por hora substitui pelo total já calculado por js vindo da outra página)
    //foreach ($subtotais as $key => $subtotal) {
    //    $subtotais[$key] = floatval(str_replace(',', '.', $subtotal));
    // }
    // Calculando o total da venda
    //$total = array_sum($subtotais) - $desconto;

    // Inserindo a venda na tabela "vendas"
    $stmt = $conn->prepare("INSERT INTO vendas (cliente_id, total) VALUES (?, ?)");
    $stmt->bind_param("id", $cliente, $totalConvertidoFloat);
    
    if ($stmt->execute()) {
        $id_venda = $stmt->insert_id; // Pegando o ID da venda recém-inserida

        // Inserindo os produtos na tabela "itens_venda"
        $stmt_item = $conn->prepare("INSERT INTO itens_venda (venda_id, produto, quantidade, preco_unitario, subtotal) VALUES (?, ?, ?, ?, ?)");
        $stmt_item->bind_param("isidd", $id_venda, $produto, $quantidade, $preco_unitario, $subtotalConvertidoFloat);

        // Percorrendo os produtos e inserindo um a um
        for ($i = 0; $i < count($produtos); $i++) {

            $produto = $produtos[$i];
            $quantidade = intval($quantidades[$i]);
            $preco_unitario = floatval(str_replace(',', '.', $valores_unit[$i]));
            $subtotalConvertidoFloat = converterParaNumero($subtotais[$i]);

            $stmt_item->execute();
        }
        
        $stmt_despacho = $conn->prepare("INSERT INTO despacho (cliente_id, venda_id, nome_empresa, prazo, data_entrega, valor) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_despacho->bind_param("iisisd", $cliente, $id_venda, $nomeFrete, $prazoFrete, $dataEntrega, $valorFrete);

        $stmt_despacho->execute();

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
