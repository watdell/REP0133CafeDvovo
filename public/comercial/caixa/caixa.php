<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
    <script src="../../../public/assets/js/comercial/despesa/despesa.js?v=<?php echo time(); ?>"></script>
    <title>Document</title>

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
                <h2>Entradas</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por descrição' oninput='doobsearch()'></input>
                <h2 id="despesas-title1">Despesas</h2>
            </div>

            <div class="innertable-content">
            
                <div id="innertable2" class="innertable" style="background-color:#caffd8">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS --> 
                </div>

                <div class="table-header">
                    <h2 id="despesas-title2">Despesas</h2>
                </div>
                    
                <div id=innertable class="innertable"  style="background-color:#ffdbca">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS -->
                </div>

            </div>

            <div class="itens_shown" style="justify-content:center">

            <div class="subtotal">
                <a style="width:40%;font-size:30px">Subtotal:  </a>
                <a id='col_cal' style="width:40%;font-size:30px"><?php

                    $sql= "SELECT valor FROM despesas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $subtotal = 0;

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }

                    $sql= "SELECT valor FROM entradas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }

                    $sql= "SELECT total FROM vendas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['total'];
                    }

                    echo "R$ "  .  number_format($subtotal, 2, ',', '.');

                    ?></a>
            </div>

            </div>
        
        </div>

    </main>
<script src="../public/assets/js/main.js"></script>
<script>
    function calcularTotal() {
        if (document.getElementById('col_cal').innerHTML[3] != '-') {
            document.getElementById('col_cal').style.color = '#0d8e03';
        } else {
            document.getElementById('col_cal').style.color = '#8e0321';
        }
        if (document.getElementById('col_cal').innerHTML.length > 20) {
            document.getElementById('col_cal').innerHTML = 'Verifique valores';
        }
    }
    calcularTotal();

    function doobsearch() {
        search("despesas",'select-search-d',true);
        search("entradas",'select-search-d',true,'innertable2');
    }

    doobsearch()

</script>

</body>
</html>