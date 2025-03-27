<!DOCTYPE html>
<html lang="pt-br">
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
            <br>
            <h1>O que deseja fazer?</h1>
            <br>
            <ul class="ul-selecione">
                <li><a href="Manual-Café-D'VOVO.docx" download="Manual-Café-D'VOVO.docx">Manual</a></li>
                <li><a href="./pessoas/pessoas.php">Registro de pessoas</a></li>
                <li><a href="../insumos/tela_insumos.php">Registro de insumos</a></li>
                <li><a href="./estoque/estoque.php">Visualizar Estoque</a></li>
                <li><a href="./excel/importar_excel.php">Importar Excel</a></li>
            </ul>
        </nav>
    </main>
    <script src="../assets/js/main.js"></script>
</body>
</html>
