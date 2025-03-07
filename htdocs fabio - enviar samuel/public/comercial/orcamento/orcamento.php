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
        
        $sql = "SELECT id_orcamento FROM orcamento ORDER BY id_orcamento DESC LIMIT 1";
        
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $lastId = $row['id_orcamento'];
        } else {
            $lastId = "No data found";
        }
        ?>

    </head>
    <body>
        <header class="topbar">Orçamentos</header>
        <main class="content" style="justify-self: center;">
            <div class="table">
                <BR>
                <label for="cliente">CLIENTE: </label>
                <select id="cliente" name="cliente" onchange="setprod()">
                
                    <?php

                        $sql=getQuery('select_all_clientes');
                        $stmt= $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while($row = $result->fetch_assoc()) {
                            ?>
                            <option value=<?php  echo str_replace(' ', '&nbsp;', $row['pessoa_id'] . '|' . $row['pais'] . '-/-' . $row['cep'] . '-/-' . $row['estado'] . '-/-' . $row['cidade'] . '-/-' . $row['bairro'] . '-/-' . $row['rua'] . '-/-' . $row['numero']); ?>> <?php  echo $row['pessoa_id'] . ' | ' . $row['nome']; ?> </option>
                            <?php
                        }
                    ?>

                </select>
                <BR>
                <div class='innertable'>
                    <div class='innerdiv'>
                        <select id='prodsel' onchange="setprod()">
                            <?php

                                $sql = "SELECT produto_id, nome, descricao, custo FROM produto";

                                if ($criterio) {
                                    $sql.= "WHERE nome LIKE '%" .$conn->real_escape_string($criterio) . "%'";
                                }

                                $result = $conn->query($sql);

                            while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php  echo $row['produto_id'] . '|' . $row['descricao'] . '|' . $row['custo'] . '|' . $row['nome']; ?>"> <?php  echo $row['nome']; ?> </option>
                                <?php
                            }
                            ?>
                        </select>
                        <input type='text' disabled id='proddesc'></input>
                        <a>Quantidade:</a>
                        <input type='number' value='1' onchange="setprod()" id='quanmult' style='width: 10%;' min='1'></input>
                        <a>Preço:</a>
                        <input type='text' id='valfinal' style='width: 10%;'></input>
                        <button onclick='addprod()' style='background-color: #b5651d;color: white;'>+</button>
                    </div>
                    <hr style='margin-top:5px'>
                    <div id='restable'></div>
                </div>
                <div class='endtable'>
                    <a> Valor Total:</a>
                    <input type='text' disabled id='valtotal'></input>
                    <button onclick='remprod()'>RESETAR</button>
                    <button id='openbutton' class="open-button" onclick="openForm()" style='background-color: #b5651d;color: white;'>CADASTRAR</button>
                    <button class="voltar" style='background-color: #b5651d;color: white;' onclick="location.href='/public/comercial/'">VOLTAR</button>
            </div>
            <div>
            <form id='field'  class='form' action='orcamento_table.php' method='post' style='display:none'>
                <BR>
                <a class='formlabel'>ID de Orcamento: </a><input id='formid' class='forminput' type='disabled'>
                <a class='formlabel'>ID do Cliente: </a><input id='formcl' class='forminput' type='disabled'>
                <a class='formlabel'>Endereço: </a><input id='formad' class='forminput' type='disabled'>
                <a class='formlabel'>Validade: </a><input id='formvl' class='forminput' type='disabled'>
                <BR>
                <input type='hidden' id='client_p' name='client_p' value=''></input>
                <input type='submit' value='CONFIRMAR' style='margin-top: 10px;'></input>
            </form>
            <div>
        </main>
        <script>
            function getlastid() {
                var lastId = <?php echo json_encode($lastId); ?>;

                return parseInt(lastId) + 1;
            }
            setprod()
        </script>
    </body>
</html>