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

        function fiend($criteria) {
            $stu = $criteria . "%";
            return $stu;
        }
        
        ?>


</head>
<body>
    <header class="topbar">ENTRADAS</header>

    <main class="content">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;">
                <h2>Entradas</h2>
                <input id='search' type='search' autocomplete="off" style='width:50%' placeholder='pesquisar por...' onchange='search("entradas","select-search")'></input>
                <select id="select-search" style="margin-left:10px;width:17%" onchange="setcook()">
                    <option id="select-search-descricao" value="descricao">DESC</option>
                    <option id="select-search-id" value="id">ID</option>
                    <option id="select-search-valor" value="valor">VALOR</option>
                    <option id="select-search-data" value="data">DATA</option>
                </select>
                <button onclick="location.href='../index.php'">VOLTAR</button>
            </div>

            <div style="display:flex;flex-direction:row;min-height:600px">

                <div id='innertable' class="innertable" style="width:100%">
                    <!-- THIS IS WHERE THE MAGIC HAPPENS -->
                </div>

            </div>

            <div class="itens_shown" style="justify-content:space-between">

            <button onclick="location.href='entradas_create.php'" style='background-color:#b5651d;width:40%'>REGISTRAR NOVA ENTRADA</button>

            <div class="subtotal">
                <a style="width:40%;font-size:30px">Subtotal:</a>
                <a style="width:40%;font-size:30px"><?php

                    $sql= "SELECT valor FROM entradas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $subtotal = 0;

                    while($row = $result->fetch_assoc()) {
                        $subtotal = $subtotal + $row['valor'];
                    }
                    echo "R$" . number_format($subtotal, 2, ',', '.');

                    ?></a>
            </div>

            </div>
        
        </div>

        
        
    </main>
<script src="../public/assets/js/main.js"></script>
<script>
    function setcook() {
        setCookie('select-search', document.getElementById("select-search").value, 2);
    }

    document.getElementById('select-search-' + getCookie('select-search','entr')).selected = true;

    search("entradas","select-search");
</script>
</body>
</html>