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
    <header class="topbar">IMPORTAR</header>

    <main class="content">

        <div class='table' style="flex-direction:column;width:350px;">
            <div class="itens_shown" style="width:100%;display:flex;flex-direction:row;">
                <h2>IMPORTAR EXCEL</h2>
                <button onclick="location.href='../index.php'">VOLTAR</button>
            </div>

            <br>

            <form class="itens_shown" action="upload_excel.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="excelFile" id="excelFile" accept=".xlsx, .xls">
                <button type="submit" name="submit">Upload</button>
            </form>

            </div>
        
        </div>
        
    </main>
<script src="../public/assets/js/main.js"></script>
</body>
</html>