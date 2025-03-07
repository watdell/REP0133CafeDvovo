<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/assets/css/main.css">
    <link rel="stylesheet" href="../../../public/assets/css/despesas/style.css?v=<?php echo time(); ?>">
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
    <header class="topbar">ENTRADAS</header>

    <main class="content" style="justify-self: center;width:50%;">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;">
                <h2>Entradas</h2>
            </div>

            <div style="display:flex;flex-direction:row;min-height:600px">

                <div class="innertable" style="width:100%">
                <div class="table_header">
                    <a style="width:20%">ID</a>
                    <a style="width:20%">descricao</a>
                    <a style="width:20%">valor</a>
                    <a style="width:20%">data</a>
                </div>
                <hr style='height:4px;background-color:black'><br>
                    <?php

                    $sql= "SELECT * FROM entradas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class='itens_shown'>
                        <a style="width:25%"><?php  
                        echo $row['identrada'];?> </a>
                        <a style="width:25%"><?php
                        echo $row['descricao'];?> </a>
                        <a style="width:25%"><?php
                        echo $row['valor'];?> </a>
                        <a style="width:25%"><?php
                        echo $row['data'];
                        ?> </a></div>
                        <hr>
                        <?php
                    }

                    ?>
                </div>

            </div>

            <div class="itens_shown" style="justify-content:space-between">

            <button onclick="location.href='entradas_create.php'" style='background-color:#b5651d;width:50%'>REGISTRAR NOVA ENTRADA</button>

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
                    echo $subtotal;

                    ?></a>
            </div>

            </div>
        
        </div>

        
        
    </main>
<script src="../public/assets/js/main.js"></script>
</body>
</html>