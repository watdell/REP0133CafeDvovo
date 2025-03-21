<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Essa parte carrega e garante que sempre vai carregar a versão mais resente em cache -->
    <link rel="stylesheet" href="../../assets/css/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../assets/css/estoque/style.css?v=<?php echo time(); ?>">
    <script src="../../assets/js/main.js?v=<?php echo time(); ?>"></script>
    <title>Estoque</title>

    <!-- Includes e conexão com a database -->
    <?php
        include '../../../serverside/queries/db_queries.php';
        include '../../../serverside/config/dbConnection.php';
        include '../../../includes/main-sidebar.php';

        $conn = dbConnection();

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }
        
    ?>


</head>
<body>
    <header class="topbar">CAIXA</header>

    <main class="content">

        <div class='table' style="flex-direction:column;">

            <div class="table-header" style="width:100%;display:flex;flex-direction:row;justify-content: space-between">
                <h2>Produtos</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por descrição' oninput='doobsearch(this.value)'></input>
                <h2 id="estoque-title1">Insumos</h2>
            </div>

            <div class="innertable-content">
                <div id="innertable" class="innertable">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS --> 
                </div>
                <div class="table-header">
                    <h2 id="estoque-title2">Insumos</h2>
                </div> 
                <div id="innertable2" class="innertable">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS -->
                </div>
            </div>

        </div>

    </main>

<script src="../../../public/assets/js/main.js"></script>
<script>
    async function doobsearch(str) {
        try {
            await main_search(str, "search_estoque.php", "produto", "innertable");
            console.log("Busca de produtos concluída!");

            await main_search(str, "search_estoque.php", "insumo", "innertable2");
            console.log("Busca de insumos concluída!");
        } catch (error) {
            console.error("Erro na busca:", error);
        }
    }

    // Chamada inicial para carregar os itens ao abrir a página
    doobsearch("");

</script>
</body>
</html>