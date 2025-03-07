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
                <li><a href="/public/cadastro-pessoas/cliente_pf.php">Pessoa Física</a></li>
                <li><a href="/public/cadastro-pessoas/cliente_pj.php">Pessoa Jurídica</a></li>
                <li><a href="/public/cadastro-pessoas/fornecedor.php">Fornecedor</a></li>
                <li><a href="/public/cadastro-pessoas/funcionario.php">Funcionário</a></li>
            </ul>
        </nav>
    </main>
<script src="../../public/assets/js/main.js"></script>
</body>
</html>
