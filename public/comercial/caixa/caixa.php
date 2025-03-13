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
    <header class="topbar">CAIXA</header>

    <main class="content">

        <div class='table' style="flex-direction:column;">
            <div class="table-header" style="width:100%;display:flex;flex-direction:row;justify-content: space-between">
                <h2>Entradas</h2>
                <h2 id="despesas-title1">Despesas</h2>
            </div>

            <div class="innertable-content">
            
                <div class="innertable" style="background-color:#caffd8">
                <div class="table_header">
                    <a  style="width:20%">ID</a>
                    <a  style="width:20%">descrição</a>
                    <a  style="width:20%">valor</a>
                    <a  style="width:20%">data</a>
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
                            <a style="width:20%"><?php  
                            echo $row['identrada'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['descricao'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['valor'];?> </a>
                            <a style="width:20%"><?php
                            echo $row['data'];
                            ?> </a></div>
                            <hr>
                            <?php
                        }

                        echo "<hr style='height:3px;background-color:black'><br>";

                        $sql= "SELECT venda_id, produto FROM itens_venda GROUP BY venda_id;";
                        $stmt= $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            ?>
                            <div class='itens_shown'>
                            <a style="width:20%"><?php  
                            echo $row['venda_id'];?> </a>
                            <a style="width:20%"><?php

                            $sql2= "SELECT nome FROM produto WHERE produto_id = '" . $row["produto"] . "' LIMIT 1";
                            $stmt2= $conn->prepare($sql2);
                            $stmt2->execute();
                            $result2 = $stmt2->get_result();

                            while($row2 = $result2->fetch_assoc()) {
                                echo $row2['nome'];      
                            }      
                            ?></a>
                            <a style="width:20%"><?php

                             $sql4= "SELECT total FROM vendas WHERE venda_id = '" . $row["venda_id"] . "'";
                             $stmt4= $conn->prepare($sql4);
                             $stmt4->execute();
                             $result4 = $stmt4->get_result();

                            while($row4 = $result4->fetch_assoc()) {
                                echo $row4['total'];  
                            } 
                            ?> </a>
                            <a style="width:20%"><?php

                                $sql1= "SELECT data_venda FROM vendas WHERE venda_id = '" . $row['venda_id'] . "' LIMIT 1;";
                                $stmt1= $conn->prepare($sql1);
                                $stmt1->execute();
                                $result1 = $stmt1->get_result();

                                while($row1 = $result1->fetch_assoc()) {
                                    echo $row1['data_venda'];
                                }

                            ?> </a></div>
                            <hr>
                            <?php
                        }

                        ?>
                    
                </div>

                <div class="table-header">
                    <h2 id="despesas-title2">Despesas</h2>
                </div>
                    
                <div class="innertable"  style="background-color:#ffdbca">
                <div class="table_header">
                    <a style="width:19%">ID</a>
                    <a style="width:19%">categoria</a>
                    <a style="width:19%">descricao</a>
                    <a style="width:19%">valor</a>
                    <a style="width:19%">data</a>
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
                        ?> </a></div>
                        <hr>
                        <?php
                    }

                    ?>
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
        </script>

</body>
</html>