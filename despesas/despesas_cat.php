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
    <?php include('../../../includes/main-sidebar.php'); ?>
    <?php include('../../../includes/topbar.php'); ?>

    <main class="content" style="justify-self: center;width:40%">
        <div class="table" style="flex-direction:column;min-height:300px">
                <div class="innerdiv"> 
                    <h1>Registrar Nova Categoria</h1>
                    <button onclick="location.href='despesas_create.php'">VOLTAR</button>
                </div>

                <br><br>

                <form action="despesas_cat_table.php" id="forms" method="POST" style='width:100%'>
                        <label for="tipo">Tipo de Categoria:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="fixo">Fixo</option>
                            <option value="variavel">Variavel</option>
                        </select>
                        <br><br>

                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" maxlength="255" required>
                        <br><br>

                    <button class="register-btn" type="submit">Registrar Categoria</button>
                </form>

        </div>
    </main>
<script src="../public/assets/js/main.js"></script>
</body>
</html>