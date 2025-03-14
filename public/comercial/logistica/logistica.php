<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
    <title>Document</title>

    <?php
        include '../../../includes/main-sidebar.php';
    ?>
</head>
<body>
    <header class="topbar">LOGISTICA</header>

    <main class="content">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;justify-content: space-between">
                <h2>PENDENTES</h2>
                <h2>ENTREGAS</h2>
            </div>

            <div class="innertable-content">
            
                <div class="innertable" style="background-color:#ffdbca">
                    <div class="table_header">
                        <a  style="width:15%">ID</a>
                        <a  style="width:25%">DATA DE VENDA</a>
                        <a  style="width:25%">DATA ESTIMADA</a>
                        <a  style="width:20%">OPT</a>
                    </div>
                    <hr style='height:4px;background-color:black'><br>

                    <div class='itens_shown'>
                        <a style="width:15%">{ID}</a>
                        <a style="width:25%">{DATA_VENDA}</a>
                        <a style="width:25%">{DATA ESTIMADA}</a>
                        <a style="width:20%">{CONFIRMAR ENTREGA}</a>
                    </div>
                </div>
            
            <div class="innertable" style="background-color:#caffd8">
                <div class="table_header">
                    <a  style="width:30%">ID</a>
                    <a  style="width:30%">DATA</a>
                    <a  style="width:30%">OPT</a>
                </div>
                <hr style='height:4px;background-color:black'><br>

                <div class='itens_shown'>
                    <a style="width:30%">{ID}</a>
                    <a style="width:30%">{DATA_VENDA}</a>
                    <a style="width:30%">{DATA_ENTREGA}</a>
                </div>
            </div>
                
        </div>  

    </main>
<script src="../public/assets/js/main.js"></script>
</body>
</html>