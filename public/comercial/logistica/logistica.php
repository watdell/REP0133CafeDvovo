<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
    <script src="../../../public/assets/js/comercial/logistica/logistica.js?v=<?php echo time(); ?>"></script>
    <title>Document</title>

    <?php
        include '../../../includes/main-sidebar.php';

        include '../../../serverside/config/dbConnection.php';

        $conn = dbConnection();
    ?>
</head>
<body>
    <header class="topbar">LOGISTICA</header>

    <main class="content">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;justify-content: space-between">
                <h2>PENDENTES</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por data de venda' onchange='search(this.value)'></input>
                <h2>ENTREGAS</h2>
            </div>

            <div class="innertable-content">
            
                <div id="innertable" class="innertable" style="background-color:#ffdbca">

                </div>
            
            <div id="innertable2" class="innertable" style="background-color:#caffd8">

            </div>
                
        </div>  

    </main>
<script src="../../../public/assets/js/main.js"></script>
<script>
    search("");
</script>
</body>
</html>