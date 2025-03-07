<?php
$nome = $_POST['nome'];
$id_cl = $_POST['id_cl'];
$id_or = $_POST['id_or'];
$data_r = $_POST['data_r'];
$data_v = $_POST['data_v'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../../public/assets/css/main.css">
        <link rel="stylesheet" href="../../../public/assets/css/orcamento/orcamento2.css?v=<?php echo time(); ?>">
        <script src="../../../public/assets/js/comercial/orcamento/orcamento.js?v=<?php echo time(); ?>"></script>
        <title>Orçamento</title>
 
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
        <header class="topbar">Orçamentos</header>
        
        <main class="content" style="justify-self: center;">

        <div class="vieworno">
            <button id="orca_table" onclick="window.location.href='orcamento.php';" style="background-color:#d9b38c">ORÇAMENTOS</button>
            <button id="orca_create" style="background-color:#b5651d">OPÇÕES</button>
        </div>
        
        <div id="firsttab" class="table_opt">
            <?php 
            echo "<div class='table_header'>";

            echo "<a style='width:19%'>ID DE ORÇAMENTO:</a>";
            echo "<a style='width:19%'>DATA DE CRIAÇÃO:</a>";
            echo "<a style='width:19%'>DATA DE VALIDADE:</a>";
            echo "<a style='width:19%'>NOME:</a>";
            echo "<a style='width:19%'>ID DE CLIENTE:</a>";
                
            echo "</div>";
            echo "<div class='table_header'>";
            
            echo "<a id='id_ord' style='width:19%;font-size:20px;color:#b5651d'>" . $id_or . "</a>";
            echo "<a style='width:19%;font-size:20px;color:#b5651d'>" . $data_r . "</a>";
            echo "<a style='width:19%;font-size:20px;color:#b5651d'>" . $data_v . "</a>";
            echo "<a style='width:19%;font-size:20px;color:#b5651d'>" . $nome . "</a>";
            echo "<a style='width:19%;font-size:20px;color:#b5651d'>" . $id_cl . "</a>";
                
            echo "</div>";
            ?>
            <hr style='width:100%'>
            <br>
            <div class='itens_shown'>
                    <a style='width:20%'> ID De Item: </a>
                    <a style='width:20%'> Nome De Produto: </a>
                    <a style='width:20%'> Quantidade: </a>
                    <a style='width:20%'> Valor: </a>
                    <a style='width:10%'> Opt </a>
            </div>
            <div class="innertable">
                
                <?php
                $sql = "SELECT * FROM itemorcamento WHERE id_orcamento = '$id_or'";

                $result = $conn->query($sql);

                $number_added = 1;

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='itens_shown'>";
                        echo "<input id='valor_a" . $number_added . "' style='width:20%' value='" . $row["id_itemorcamento"] . "' readonly></input>";
                        echo "<input id='valor_b" . $number_added . "' style='width:20%' value='" . $row["nome_produto"] . "' readonly></input>";
                        echo "<input id='valor_c" . $number_added . "' style='width:20%' value='" . $row["quantidade"] . "' readonly></input>";
                        echo "<input style='width:20%' value='" . $row["valor_produto"] . "' readonly id='valor_item" . $number_added . "'></input>";
                        echo "<button onclick='del_quewe(" . $row["id_itemorcamento"] . "," . $number_added . ")' style='width: 10%;background-color:#d9534f'>DEL</input>";
                        echo "</div>";
                        $number_added ++;
                    }
                } else {
                    echo "";
                }
                ?>
                <div id='restable' style='width:100%'></div>
            </div>
            
            

            <div class='itens_shown'>
            <form id='field'  class='form' action='item_orcamento_del.php' method='post' style='width:35%'>
                <input type='hidden' id='client_p' name='client_p' value=''></input>
                <input type='submit' value='CONFIRMAR MUDANÇAS' style='width:100%;align-self:center;background-color:#b5651d'></input>
                </form>
                <a style='width:5%;align-self:center'>Valor Total: </a>
                <input style='width:15%;align-self:center' id='valor_label' readonly></input>
            <form id='fielded'  class='form' action='orcamento_del.php' method='post' style='width:35%'>
                <input type='hidden' id='deleter' name='deleter' value='id_or'></input>
                <input type='submit' value='DELETAR ORÇAMENTO' style='width:100%;align-self:center;background-color:#d9534f'></input>
                </form>
            </div>
        </div>
        <BR>
    </body>
    <script>
        document.getElementById('deleter').value = document.getElementById('id_ord').innerHTML;
        total_value_i();
        setprod_i()
    </script>
</html>
