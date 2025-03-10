<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/cadastrar-produtos/forms-style.css">
    <title>Vendas</title>
    <script>
        // Função para formatar o campo como moeda
        function formatCurrency(input) {
            let value = input.value.replace(/\D/g, ''); // Remove caracteres não numéricos
            value = value.replace(/(\d{2})$/, ',$1'); // Coloca a vírgula antes dos dois últimos números
            value = value.replace(/(?=(\d{3})+(\D))\B/g, '.'); // Adiciona ponto como separador de milhar
            input.value = 'R$ ' + value; // Adiciona o prefixo "R$" e retorna o valor formatado
        }
    </script>
</head>
<body>
<?php include('../../../includes/main-sidebar.php'); ?>
<?php include('../../../includes/topbar.php'); ?>
    <div class="content">
        

    
    <main class="content">
        <div class="site-content">
            <div class="main-box" id="main">

                <ul class="nav-bar">
                    <li id="li-1">
                        <a id="arrow-1" class="active">Escolha<div class="arrow right"></div></a>
                    </li>
                    <li id="li-2">
                        <a id="arrow-2"><div class="arrow left"></div>Pagamento<div class="arrow right"></div></a>
                    </li>
                    <li id="li-3">
                        <a id="arrow-3"><div class="arrow left"></div>Conclusão</a>
                    </li>
                </ul>

                <div class="form-display" id="purchase-type-form" style="display:flex;">
                    <div>

    </div>
        <form id="posVendasForm" class="form-group" method="post" action="../pagamento/processamento-pag.php">
            <h2>Formulário de Vendas</h2>
            <fieldset class="fieldset">
                <label for="codigoVenda">ID Venda</label>
                <input type="text" id="codigoVenda" name="codigoVenda" placeholder="Digite o código da venda" required>

                <label for="codigoOrcamento">ID do Orçamento</label>
                <input type="text" id="codigoOrcamento" name="codigoOrcamento" placeholder="Digite o código do orçamento" required>

                <label for="formadepagamento">Forma de Pagamento</label>
                <select id="formadepagamento" name="formadepagamento" required>
                    <option value="" disabled selected>Selecione...</option>
                    <option value="cartao">Cartão</option>
                    <option value="pix">Pix</option>
                    <option value="dinheiro">Dinheiro</option>
                    <option value="cheque">Cheque</option>
                </select>

                <label for="totalvenda">Total da Venda</label>
                <!-- Input para o valor total com formatação monetária -->
                <input type="text" id="totalvenda" name="totalvenda" placeholder="R$ 0,00" required oninput="formatCurrency(this)">

                <label for="dataVenda">Data da Venda</label>
                <input type="date" id="dataVenda" name="dataVenda" required>

                <button type="submit" class="register-btn">Enviar</button>
                <br>

                <button class="register-btn" onclick="location.href='/public/comercial/pos-venda/pos-venda.php'">Ir Para Pós-Venda</button>

            </fieldset>
        </form>
       
    </div>
</body>
</html>
