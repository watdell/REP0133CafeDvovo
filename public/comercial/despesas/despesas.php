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
    <header class="topbar">DESPESAS</header>

    <main class="content" style="justify-self: center;width:80%;">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;">
                <h2>Despesas</h2>
            </div>

            <div style="display:flex;flex-direction:row;min-height:600px">
            
                <div class="innertable" style="display:none">
                <div class="table_header">
                    <a  style="width:20%">ID</a>
                    <a  style="width:20%">ID Orçamento</a>
                    <a  style="width:20%">ID Cliente</a>
                    <a  style="width:20%">data</a>
                </div>
                <hr style='height:4px;background-color:black'><br>
                    
                        <?php

                        $sql= "SELECT * FROM vendas";
                        $stmt= $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            ?>
                            <div class='itens_shown'>
                            <a style="width:20%"><?php  
                            echo $row['idVendas'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['idOrcamento'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['IdCliente'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['dataVenda'];
                            ?> </a></div>
                            <hr>
                            <?php
                        }

                        ?>
                    
                </div>

                <div class="innertable" style="width:100%">
                <div class="table_header">
                    <a style="width:19%">ID</a>
                    <a style="width:19%">categoria</a>
                    <a style="width:19%">descricao</a>
                    <a style="width:19%">valor</a>
                    <a style="width:19%">data</a>
                    <a style="width:3%">DEL</a>
                </div>
                <hr style='height:4px;background-color:black'><br>
                    <?php

                    $sql= "SELECT * FROM despesas";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()) {
                        ?>
                        <div class='itens_shown'>
                        <a style="width:19%"><?php  
                        echo $row['iddespesa'];?> </a>
                        <a style="width:19%"><?php
                        echo $row['categoria'];?> </a>
                        <a style="width:19%"><?php
                        echo $row['descricao'];?> </a>
                        <a style="width:19%"><?php
                        echo $row['valor'];?> </a>
                        <a style="width:19%"><?php
                        echo $row['data'];
                        if ($row['valor'] == 0){
                            ?>
                            <script>window.alert('Verifique o ID : <?php echo $row['iddespesa'];?>')</script>
                            <?php
                        }
                        ?> </a>
                        <form id='field' action='despesas_del.php' method='post'>
                            <input type='hidden' name='id' value='<?php echo $row["iddespesa"]?>'>
                            <button type="submit">X</button></form>
                        </div>
                        <hr>
                        <?php
                    }

                    ?>
                </div>

            </div>

            <div class="itens_shown" style="justify-content:space-between">

            <button onclick="location.href='despesas_create.php'" style='background-color:#b5651d;width:30%'>REGISTRAR NOVA DESPESA</button>

            <div class="subtotal">
                <a style="width:40%;font-size:30px">Subtotal:</a>
                <a style="width:40%;font-size:30px"><?php

                    $sql= "SELECT valor FROM despesas";
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
</body>
</html>