<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/main.css">

    
    <title>Sistema - Café de Vovô</title>
</head>
<body>
    <?php include('../../includes/main-sidebar.php'); ?>
    <?php include('../../includes/topbar.php'); ?>

    <main class="content">
        <div class="navbar" id="navbar"></div>
        <nav class="menu" id="menu">
            <h1>O que você gostaria de registrar?</h1>
            <br>
            <ul class="ul-selecione">
                <li><a href="/public/comercial/orcamento/orcamento.php">Orçamento</a></li>
                <li><a href="/public/comercial/venda/venda.php">Venda</a></li>
                <!-- <li><a href="/public/servicos/cadastro-servicos/servicos_home.php">Serviços</a></li>
                <li><a href="/public/comercial/pagamento/pagamento.php">Pagamento</a></li>
                <li><a href="/public/comercial/pos-venda/pos-venda.php">Pós Venda</a></li>-->
                <li><a href="/public/comercial/despesas/despesas.php">Despesa</a></li> 
                <li><a href="/public/comercial/entradas/entradas.php">Entradas</a></li> 
                <li><a href="/public/comercial/caixa/caixa.php">Caixa</a></li>

            </ul>
        </nav>
    </main>
<script src="../../public/assets/js/main.js"></script>
</body>
</html>
