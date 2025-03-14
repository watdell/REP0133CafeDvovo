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
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <main class="content" style="justify-self: center;width:40%">
        <div class="table" style="flex-direction:column;min-height:400px">
                <div class="innerdiv"> 
                    <h1>Registrar Nova Entrada</h1>
                    <button onclick="location.href='entradas.php'">VOLTAR</button>
                </div>

                <br><br>

                <form action="entradas_table.php" id="forms" method="POST" style='width:100%;display:flex;flex-direction:column;'>
                        <br><br>
                        
                        <label for="nome">Descrição:</label>
                        <input type="text" id="desc" name="desc" maxlength="255" required style='width:100%;'>

                        <br>

                        <label for="nome">Valor:</label>
                        <input type="number" step='0.01' id="val" name="val" maxlength="255" required style='width:100%;' onchange='thewarn()'>

                        <br>
                        <a id='valwarn' class='valwarn'>VALOR SERÁ REGISTRADO COMO POSITIVO</a>     
                        <br>

                        <div class="innerdiv" style="justify-content:space-evenly">

                        <button class="register-btn" type="submit"  style="width:45%">Registrar Entrada</button>

                        </div>

                </form>

        </div>
    </main>
<script src="../public/assets/js/main.js">
</script>
</body>
</html>